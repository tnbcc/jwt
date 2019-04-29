<?php
namespace App\Services\Common;

use App\Http\Resources\Api\Admin\AdminResource;
use App\Models\Admin\Admin;
use App\Traits\Api\ApiResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelService
{
    use ApiResponse;

    const EXCEL_DATA_TYPE_ADMIN  = 'admin';
    const EXCEL_DATA_TYPE_MEMBER = 'member';

    /**
     * User：asa
     * Date: 2019/03/06 0021 13:06
     * @param string $fileName
     * @param array $title
     * @param array $data
     * @return mixed
     */
    public function toExcel(string $fileName, array $title, array $data)
    {
        try {
            Excel::create($fileName, function ($excel) use ($data, $title) {
                $excel->sheet('sheet', function ($sheet) use ($data, $title) {
                    try {
                        $sheet->fromArray($data, null, 'A1', true, false);
                    } catch (\Exception $e) {
                        return $this->failed('导出失败', 400);
                    }
                    $sheet->prependRow($title);
                });
            })->store('xls', public_path('uploads/excel/exports'));

            $data =  [
                'download_url' => route('excel.download', ['file'=> public_path('/uploads/excel/exports/'.$fileName.'.xls')])
            ];
            return $this->success($data);
        } catch (\Exception $e) {
            return $this->failed('导出失败', 400);
        }
    }


    public function createData(string $sign, array $ids)
    {
         switch ($sign) {
             case self::EXCEL_DATA_TYPE_ADMIN:
                 $admins = Admin::query()->find($ids);
               $datas = AdminResource::collection($admins);
               break;
             case self::EXCEL_DATA_TYPE_MEMBER:
         }
    }


    public function download(Request $request)
    {
       return response()->download($request->input('file'));
    }


}