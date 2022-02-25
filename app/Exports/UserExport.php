<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Str;
use URL;

class UserExport implements FromCollection, ShouldAutoSize, WithEvents, WithHeadingRow, WithHeadings, WithMapping
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

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            blink()->beautify($user->phone),
            $user->email,
            $user->source,
            $user->statusText,
            (string) $user->tests_count,
            config('limits.ACTION') == 'checks' || Str::contains(URL::current(), 'test') ? (string) $user->checks_count : null,
            config('limits.ACTION') == 'scanners' || Str::contains(URL::current(), 'test') ? (string) $user->scanners_count : null,
            $user->created_at->format('d.m.Y H:i')
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Имя',
            'Телефон',
            'Email',
            'Источник',
            'Статус',
            'Тесты',
            config('limits.ACTION') == 'checks' || Str::contains(URL::current(), 'test') ? 'Чеки' : null,
            config('limits.ACTION') == 'scanners' || Str::contains(URL::current(), 'test') ? 'Сканирования' : null,
            'Дата'
        ];
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
