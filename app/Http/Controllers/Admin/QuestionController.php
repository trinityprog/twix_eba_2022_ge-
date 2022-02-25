<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\EmailSender;
use App\Models\Question;
use App\Services\ApiService;
use App\Services\BotNotificationService;
use Illuminate\Http\Request;
use Mail;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::where('source', 'telegram')->latest()->paginate(25);

        return view('admin.questions.index', compact('questions'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('admin.questions.edit', compact('question'));
    }

    public function update(Request $request, $id, BotNotificationService $botNotificationService)
    {
        $data = $this->validate($request, [
            'answer' => 'required'
        ]);


        $data['status'] = 1;

        $question= Question::findOrFail($id);
        $question->update($data);

        if($question->source == "web")
            Mail::to([$data['email']])->send(new EmailSender($data));


        if($question->source == "telegram")
        {
            $botNotificationService->questionAnswer([
                'phone' => $question->phone,
                'question' => $question->question,
                'answer' => $question->answer,
            ]);
        }

        return redirect()->route('admin.questions.index')->with('message', 'Question #'.$id.' обновлен!');
    }
}
