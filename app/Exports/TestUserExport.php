<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TestUserExport implements FromCollection, ShouldAutoSize, WithEvents, WithHeadingRow, WithHeadings, WithMapping
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->data;
    }

    public function map($test_user): array
    {
        return [
            $test_user->id,
            $test_user->user->name,
            blink()->beautify($test_user->user->phone),
            $test_user->user->email,
            $test_user->result->showAnswersText,
            $test_user->prize ? $test_user->prize->general : '-',
            $test_user->prize ? ($test_user->scanner ? 'подтвержден' : 'не подтвержден') : '-',
            $test_user->created_at->format('d.m.Y H:i'),
            $test_user->user->delivery ? $test_user->user->delivery->surname : '-',
            $test_user->user->delivery ? $test_user->user->delivery->name : '-',
            $test_user->user->delivery ? $test_user->user->delivery->index : '-',
            $test_user->user->delivery && $test_user->user->delivery->region ? $test_user->user->delivery->region->general : '-',
            $test_user->user->delivery ? $test_user->user->delivery->locality : '-',
            $test_user->user->delivery ? $test_user->user->delivery->street : '-',
            $test_user->user->delivery ? $test_user->user->delivery->building : '-',
            $test_user->user->delivery ? $test_user->user->delivery->apartament : '-',
            $test_user->user->delivery ? $test_user->user->delivery->commentary : '-',
            $test_user->user->delivery ? $test_user->user->delivery->created_at->format('d.m.Y H:i') : '-',
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Имя', 'Телефон', 'E-mail', 'Результат', 'Приз', 'Статус', 'Дата', 'Фамилия', 'Имя', 'Индекс', 'Область', 'Населённый пункт', 'Улица', 'Дом', 'Квартира', 'Комментарий', 'Дата'];
    }
    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class=> function(AfterSheet $event) {
                $cellRange = 'A1:Z1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(11)->setBold(true);
            },
        ];
    }

}
