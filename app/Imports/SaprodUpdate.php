<?php

namespace App\Imports;

use App\Models\Saprod;
use App\Models\Saprodsucursal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SaprodUpdate implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $comercial  = session('comercialid') ;

        foreach ($rows as $row)
        {
            $saprod = Saprod::where(['codprod'=> $row['codprod'], 'comercial' => $comercial])->first();
            if($saprod){

                $saprod->update([
                    'preciod'  => (isset($row['costo'])      and $row['costo']     )? $row['costo']      :0,
                    'costod'   => (isset($row['precio1'])    and $row['precio1']   )? $row['precio1']    :0,
                    'costod2'  => (isset($row['precio2'])    and $row['precio2']   )? $row['precio2']    :0,
                    'costod3'  => (isset($row['precio3'])    and $row['precio3']   )? $row['precio3']    :0,
                    'descrip'  => (isset($row['descrip'])    and $row['descrip']   )? $row['descrip']    :'',
                    'descrip2' => (isset($row['descrip2'])   and $row['descrip2']  )? $row['descrip2']   :'',
                    'descrip3' => (isset($row['descrip3'])   and $row['descrip3']  )? $row['descrip3']   :'',
                    'descrip4' => (isset($row['descrip4'])   and $row['descrip4']  )? $row['descrip4']   :'',
                    'marca'    => (isset($row['marca'])      and $row['marca']     )? $row['marca']      :'',
                    'refere'   => (isset($row['referencia']) and $row['referencia'])? $row['referencia'] :'',
                ]);

                $prodsucursal = Saprodsucursal::with('producto')->where('codprod', $row['codprod'])->get();
                if($prodsucursal)
                    foreach ($prodsucursal as $item){
                        if($item->producto->comercial == $comercial)
                            $item->delete();
                    }

            }

        }
    }
}
