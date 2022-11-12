<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class NewsController extends Controller
{

   public function index()
   {
      return view('admin.news.index');
   }

   public function create()
   {
      return view('admin.news.create');
   }

   public function edit($id)
   {
      $data = News::findOrFail($id);
      return view('admin.news.edit')->with([
         'data' => $data
      ]);
   }

   public function destroy($id)
   {
      $item = News::findOrFail($id);
      $item->delete();
      return redirect()->route('admin.news.index')->withFlashSuccess(__('Data Deleted Successfully'));
   }

   public function store(Request $request)
   {
      $request->validate([
         'title'         => 'required|max:200',
         'description'   => 'required',
         'status'        => 'in:draft,published',
      ]);
      $data = [
         'title' => $request->title,
         'description' => $request->description,
         'status' => ($request->status) ? $request->status : 'draft',
      ];
      if ($request->image) {
         $data['image'] = $request->file('image')->store('media_news', 'public');
      }
      $data['slug'] = Str::slug($request->title);
      if (isset($request->id)) {
         $item = News::findOrFail($request->id);
         $query = $item->update($data);
      } else {
         $query = News::create($data);
      }
      if ($query) {
         return redirect()->route('admin.news.index')->withFlashSuccess(__('Data Saved Successfully'));
      } else {
         return redirect()->route('admin.news.index')->withFlashDanger(__('Data Failed To Save'));
      }
   }

   public function datatable(Request $request)
   {
      $data = News::query();
      if(!$request->order[0]['column']){
         $data = $data->orderBy('id', 'desc');
      }
      return DataTables::of($data)
         ->make(true);
   }
}
