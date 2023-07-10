<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Models\DetailAbsensi;
use App\Models\Absensi;
use App\Models\Pengawas;
use App\Models\Karyawan;
use App\Models\Sift;
// use Maatwebsite\Excel\Concerns\FromView;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Events\AfterSheet;
// use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;

class LaporanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\view
    */

    protected $dataS1;
    protected $dataS2;
    protected $dataS3;
    protected $namakapal;
    protected $tanggal;
    protected $P1;
    protected $P2;
    protected $P3;

    public function __construct($dataS1,$dataS2,$dataS3,$namakapal,$tanggal,$P1,$P2,$P3)
    {
        $this->dataS1 = $dataS1;
        $this->dataS2 = $dataS2;
        $this->dataS3 = $dataS3;
        $this->namakapal = $namakapal;
        $this->tanggal = $tanggal;
        $this->P1 = $P1;
        $this->P2 = $P2;
        $this->P3 = $P3;
    }

    public function collection()
    {
        $no= 1;
        // Menyiapkan data yang akan diekspor dalam bentuk Collection
        $collection = new Collection();

        // Menambahkan header custom
        $collection->push([
            'NO',
            'JAM KERJA',
            '00.00-08.00',
            '08.00-16.00',
            '16.00-00.00',
        ]);

        // Menambahkan baris shift I
        $collection->push([
            '',
            'SHIFT',
            'I',
            'II',
            'III',
            'TANGGAL',
            'KAPAL',
        ]);

        // Menambahkan data S1
        if (isset($this->dataS1)) {
            $collection->push([
                $no++,
                $this->P1,
                'HADIR',
                '-',
                '-',
                $this->tanggal,
                $this->namakapal,
            ]);
    
            foreach ($this->dataS1 as $item1) {
                $collection->push([
                    $no++,
                    $item1->name_karyawan,
                    $item1->status,
                    '-',
                    '-',
                ]);
            }
        }

        // Menambahkan data S2
        if (isset($this->dataS2)) {
            $collection->push([
                $no++,
                $this->P2,
                '-',
                'HADIR',
                '-',
                $this->tanggal,
                $this->namakapal,
            ]);
    
            foreach ($this->dataS2 as $item2) {
                $collection->push([
                    $no++,
                    $item2->name_karyawan,
                    '-',
                    $item2->status,
                    '-',
                ]);
            }
        }
    

        // Menambahkan data S3
        if (isset($this->dataS3)) {
            $collection->push([
                $no++,
                $this->P3,
                '-',
                '-',
                'HADIR',
                $this->tanggal,
                $this->namakapal,
            ]);
    
            foreach ($this->dataS3 as $item3) {
                $collection->push([
                    $no++,
                    $item3->name_karyawan,
                    '-',
                    '-',
                    $item3->status,
                ]);
            }
        }
    

        return $collection;
    }

    public function headings(): array
    {
        // Mengembalikan judul kolom
        return [
            '',
            '',
            '',
            '',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'DDDDDD',
                        ],
                    ],
                ]);
            },
        ];
    }

    // public function view(): View
    // {
    //     $no=1;
    //     $dataS1 = $this->dataS1;
    //     $dataS2 = $this->dataS2;
    //     $dataS3 = $this->dataS3;
    //     $namakapal = $this->namakapal;
    //     $tanggal = $this->tanggal;
    //     $P1 = $this->P1;
    //     $P2 = $this->P2;
    //     $P3 = $this->P3;

    //     return view('Laporan/excel_laporan_kapal', compact('no','dataS1','dataS2','dataS3','namakapal','tanggal','P1','P2','P3'));
    // }
}
