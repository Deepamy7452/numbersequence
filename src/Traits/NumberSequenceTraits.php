<?php
namespace Amy\Numbersequence\Traits;


use Amy\Numbersequence\Services\Interfaces\NumberSequenceInterfaces;
// use App\Models\Number_sequence;
use amy\numbersequence\Models\NumberSequenceMapV2;
use amy\numbersequence\Models\NumberSequenceV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

trait NumberSequenceTraits
{
    private $NumberSequenceService;

    public function __construct(NumberSequenceInterfaces $NumberSequenceService)
    {
        // dd( $this->middleware('auth'));
        $this->NumberSequenceService = $NumberSequenceService;
        // $this->middleware('auth');
    }

    public function index(NumberSequenceV2 $num_seq)
    {
        // if (Gate::any(['Number Sequence List Full Access', 'Number Sequence List View'], $num_seq)){
            $map = [];
            $data = NumberSequenceMapV2::get();
            foreach ($data as $map_data) {
                if ($map_data->number_sequence_id) {
                    $map[] = $map_data->number_sequence_id;
                }
            }
            $data = $this->NumberSequenceService->all();
            return view("numbersequence::number_sequence.number_sequence_list.index", compact("data", "map"));
        // }
        // return view('errors.403');
    }
    public function addSeq()
    {
        return view("numbersequence::number_sequence.number_sequence_list.add");
    }
    public function indexMap(NumberSequenceMapV2 $seq_map)
    {
        if (Gate::any(['Number Sequence Map Full Access', 'Number Sequence Map View'], $seq_map)){
            $map = [];// all mapped id of seq
            $all_seq=[];
            $data = NumberSequenceMapV2::get();
            foreach ($data as $map_data) {
                if ($map_data->number_sequence_id) {
                    $map[] = $map_data->number_sequence_id;
                }
            }
            $seq_data=NumberSequenceV2::get();
            foreach ($seq_data as $sequence) {
                $all_seq[]=$sequence->id;
            }
            $differ=array_diff($all_seq,$map);

            //all unmapped
            $no_seq = NumberSequenceV2::whereIn('id',$differ)->get();
            $data = $this->NumberSequenceService->allMap();
            return view("numbersequence::number_sequence.number_sequence_map.index", compact("data","no_seq"));
        }
        return view('errors.403');
    }
    public function storeSeq(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $id = $this->NumberSequenceService->store_sequence($request);
            DB::commit();
            // self::alertSuccess();
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
           Alert::error('Error',''.$e->getMessage());
           return redirect()->back();
            // throw $e;
        }
        return redirect('number-seq/sequence-list');
    }
    public function mapSeq(Request $request){
        // dd($request->all());
        try{
               $data = $this->NumberSequenceService->mapSequence($request);
                if($data){
                    self::successfully_updated();
                }
                return redirect('number-seq/sequence-map');
            }
            catch(\Exception $e){
               Alert::error('Error',''.$e->getMessage());
               return redirect()->back();
            }

    }
    public function delete_Seq(Request $request){
        try{
               $id = convert_uudecode(base64_decode($request->id));
        $this->NumberSequenceService->deleteSeq($id);
        self::successfully_deleted();
        return redirect('number-seq/sequence-list');
            }
            catch(\Exception $e){
               Alert::error('Error',''.$e->getMessage());
               return redirect()->back();
            }

    }

    public function showLogdata(Request $request,$id){
        try{
                $data = $this->NumberSequenceService->showLogdetails($id);
        return response()->json($data);
            }
            catch(\Exception $e){
               Alert::error('Error',''.$e->getMessage());
               return redirect()->back();
            }

    }

}


