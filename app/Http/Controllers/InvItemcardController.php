<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Inv_itemcard;
use App\Models\Inv_itemcard_category;
use App\Models\Inv_uoms;
use Illuminate\Http\Request;

class InvItemcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = Inv_itemcard::select()->where(["com_code" => $com_code])->orderby('id', 'DESC')->paginate(\PAGINATING_COUNT);

        if (!empty($data)) {

            foreach ($data as $info) {
                $info->added_by_admin = Admin::where('id', $info->added_by)->value('name');
                $info->inv_itemcard_categories_name = Inv_itemcard_category::where(['id' => $info->inv_itemcard_categories_id])->value('name');
                $info->parent_inv_itemcard_name = Inv_itemcard::where(['id' => $info->parent_inv_itemcard_id])->value('name');
                $info->uom_name = Inv_uoms::where(['id' => $info->uom_id])->value('name');
                $info->retail_uom_name = Inv_uoms::where(['id' => $info->retail_uom_id])->value('name');


                if($info->updated_by > 0 and $info->updated_by !=null){
                    $info->updated_by_admin =Admin::where('id',$info->updated_by)->value('name');
                }

            }
        }
        $inv_itemcard_categories = Inv_itemcard_category::select('id', 'name')->where(['com_code' => $com_code, 'active' => 1])->orderby('id', 'DESC')->get();
        return view('admin.inv_itemcard.index', ['data' => $data, 'inv_itemcard_categories' => $inv_itemcard_categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $com_code = auth()->user()->com_code;
        $inv_itemcard_categories = Inv_itemcard_category::select('id', 'name')->where(['com_code' => $com_code, 'active' => 1])->orderby('id', 'DESC')->get();
        $inv_uoms_parent = Inv_uoms::select('id', 'name')->where(['com_code' => $com_code, 'active' => 1, 'is_master' => 1])->orderby('id', 'DESC')->get();
        $inv_uoms_child = Inv_uoms::select('id', 'name')->where(['com_code' => $com_code, 'active' => 1, 'is_master' => 0])->orderby('id', 'DESC')->get();
        //   $inv_item_data= Inv_itemcard::select('id','name')->where(['com_code'=>$com_code , 'active'=>1 ])->orderby('id','DESC')->get();
        return view('admin.inv_itemcard.create', compact('inv_itemcard_categories', 'inv_uoms_parent', 'inv_uoms_child'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inv_itemcard  $inv_itemcard
     * @return \Illuminate\Http\Response
     */
    public function show(Inv_itemcard $inv_itemcard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inv_itemcard  $inv_itemcard
     * @return \Illuminate\Http\Response
     */
    public function edit(Inv_itemcard $inv_itemcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inv_itemcard  $inv_itemcard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inv_itemcard $inv_itemcard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inv_itemcard  $inv_itemcard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inv_itemcard $inv_itemcard)
    {
        //
    }
}
