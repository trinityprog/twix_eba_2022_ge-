@component('mail::message')
# Новый вопрос

@component('mail::table')
| Имя                 | E-mail               | Телефон              |
| ------------------- |:--------------------:| --------------------:|
|{{ $question->name }}|{{ $question->email }}|{{ $question->phone }}|
@endcomponent
<br>
<hr>
<br>
{{ $question->question }}
@endcomponent
