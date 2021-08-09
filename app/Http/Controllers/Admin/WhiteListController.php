<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChannelWhiteList;
use Illuminate\Http\Request;



class WhiteListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ChannelWhiteList::orderBy('id','desc')->paginate(40);

        return view('dashboard.white-list.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
        ]);
        ChannelWhiteList::create([
            'url' => $request->url,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ChannelWhiteList::find($id);

        $item->delete();

        return redirect()->back();
    }


    public function storeCSV(Request $request)
    {

        $result = false;

            if ( isset($_FILES["file"])) {

                //if there was an error uploading the file
                if ($_FILES["file"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";

                }
                else {
                    $path = $_FILES['file']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $storagename = 'csv/'.time().'.'.$ext;
                    move_uploaded_file($_FILES["file"]["tmp_name"], $storagename);

                    if($ext == 'csv'){
                        $result = true;
                        $row = 1;
                        if (($handle = fopen($storagename, "r")) !== FALSE) {
                            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                $num = count($data);
                                $row++;
                                for ($c=0; $c < $num; $c++) {
                                    if(filter_var($data[$c], FILTER_VALIDATE_URL) && !ChannelWhiteList::where('url', $data[$c])->first()) {
                                        ChannelWhiteList::create([
                                            'url' => $data[$c]
                                        ]);
                                    }
                                }
                            }
                            fclose($handle);
                        }
                    }
           /*         elseif($ext == 'xlsx'){
                        $result = true;
                        if ( $xlsx = SimpleXLSX::parse($storagename) ) {
                            foreach ($xlsx->rows() as $row){
                                if(filter_var($row, FILTER_VALIDATE_URL) && !ChannelWhiteList::where('url', $row)->first()){
                                    ChannelWhiteList::create([
                                        'url' => $row
                                    ]);
                                }
                            }
                        } else {
                            $result = false;
                            echo SimpleXLSX::parseError();
                        }
                    }*/
                }
            }
            if($result){
                return back()->with('success','File is uploaded');
            }else{
                return back()->with('success','Something wrong');
            }

    }
}
