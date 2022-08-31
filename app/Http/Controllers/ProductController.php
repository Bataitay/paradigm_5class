<?php

namespace App\Http\Controllers;

use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }
    public function index(){
        return response()->json(
            $this->productService->all(),
            200);
    }
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extendshion = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ', '_', $fileNameOnly) . '_' . rand() . '_' . time() . '.' . $extendshion;
            $path = 'http://127.0.0.1:8000/storage/' . $request->file('image')->store('/posts', 'public');

            $data['image'] = $path;
        }
        return response()->json(
            $this->productService->create($data),
            200);
    }
    public function show($id)
    {
        return response()->json(
            $this->productService->find($id)
            ,200
        );
    }
    public function update($id, Request $request){
        $data = $request->all();
        if ($request->hasFile('image')) {
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extendshion = $request->file('image')->getClientOriginalExtension();
            $compPic = str_replace(' ', '_', $fileNameOnly) . '_' . rand() . '_' . time() . '.' . $extendshion;
            $path = 'http://127.0.0.1:8000/storage/' . $request->file('image')->store('/posts', 'public');

            $data['image'] = $path;
        }
        return response()->json(
            $this->productService->update( $data, $id),
            200
        );
    }
    public function destroy( $id){

        return response()->json(
            $this->productService->delete($id),
            200
        );
    }
}
