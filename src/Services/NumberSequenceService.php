<?php
namespace Amy\Numbersequence\Services;

use Amy\Numbersequence\Services\Interfaces\NumberSequenceInterfaces;
use App\Models\Number_seq_MapLog;
use Amy\numbersequence\Models\NumberSequenceV2;
use Amy\numbersequence\Models\NumberSequenceMapV2;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class NumberSequenceService implements NumberSequenceInterfaces
{

    public function all()
    {
        $data = NumberSequenceV2::with('user')->get();
        // dd($data);
        return $data;
    }
    public function allMap()
    {
        $data = NumberSequenceMapV2::with('user', 'number_sequence')->get();
        // dd($data);
        return $data;
    }
    public function store_sequence($all_data)
    {
        $companyId = Auth::user()->company_id;
        $i = 0;
        foreach ($all_data->sequence_code as $number) {
            $old = NumberSequenceV2::where('number_sequence_code', $number)->first();
            $j = 0;
            if ($old) {
                $j++;
            } else {
                $rng = $all_data->range_no[$i];
                $formate = $all_data->constant_no[$i];
                while ($rng) {
                    $formate = $formate . '#';
                    $rng--;
                }
                NumberSequenceV2::create([
                    'number_sequence_code' => $number,
                    'name' => $all_data->sequence_name[$i],
                    'constant_no' => $all_data->constant_no[$i],
                    'range_no' => $all_data->range_no[$i],
                    'created_by' => Auth::user()->id,
                    'format' => $formate,
                    'tbl_entity_id' => $companyId,
                ]);
            }
            $i++;
        }
        if ($j > 0) {
            Alert::warning('Error', 'This number sequence code is already in use')->autoClose(4000);
            return redirect('number-seq/sequence-list');
        }
        Alert::success('Success', 'Record is created successfully')->autoClose(4000);
        return redirect('number-seq/sequence-list');
    }

    public function mapSequence($data)
    {
        // dd($data->all());
        $map_data = NumberSequenceMapV2::find($data->formid);
        if ($map_data) {
            $map_data->number_sequence_id = $data->sequencemaping;
            $map_data->maping_date = now();
            $map_data->created_by = Auth::user()->id;
            $map_data->save();
        }

        $new_record = new Number_seq_MapLog();
        $new_record->tbl_entity_id = Auth::user()->company_id;
        $new_record->map_id = $data->formid;
        $new_record->sequence_id = $data->sequencemaping;
        $new_record->mapping_date = now();
        $new_record->created_by = Auth::user()->id;
        $new_record->save();

        return true;

    }
    public function deleteSeq($id)
    {
        $data = NumberSequenceMapV2::where('number_sequence_id', $id)->first();
        if ($data) {
            Alert::warning('This record can not be deleted due to mapping !')->autoClose(4000);
            return redirect('number-seq/sequence-list');
        } else {
            $line = NumberSequenceV2::find($id);
            $line->delete();
        }
        return true;
    }
    public function showLogdetails($id)
    {
        $data = Number_seq_MapLog::with('user', 'sequence')->where('map_id', $id)->get();
        // dd($data);
        return $data;

    }
}
