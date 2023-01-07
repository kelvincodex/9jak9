<?php

namespace App\Service;

use App\Http\Requests\Brand\CreateBrandRequest;
use App\Http\Requests\Brand\ReadByBrandIdRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Requests\Gallery\CreateGalleryRequest;
use App\Http\Requests\Gallery\ReadByGalleryIdRequest;
use App\Http\Requests\Gallery\UpdateGalleryRequest;
use App\Models\Brand;
use App\Models\Gallery;
use App\Util\baseUtil\ResponseUtil;
use App\Util\exceptionUtil\ExceptionCase;
use App\Util\exceptionUtil\ExceptionUtil;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;

class GalleryService
{
    use ResponseUtil;

    public function create(CreateGalleryRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //TODO ACTION

            /*todo check if file exist */
            if (!$request->hasFile('galleryItem'))
                throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "COULDN'T NOT FIND IMAGE");
            $fileName = time().'_'.$request->file('galleryItem')->getClientOriginalName();
            $request->file('galleryItem')->move(public_path('storage/galleries'), $fileName);
//            dd(URL::asset("storage/galleries/$fileName"));

            $response = Gallery::create(array_merge($request->all(),[
                'galleryItem'=> URL::asset("storage/galleries/$fileName")
            ]));

            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);

            return $this->SUCCESS_RESPONSE("GALLERY CREATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }


    public function update(UpdateGalleryRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());

            //TODO ACTION
            $gallery = Gallery::find($request['galleryId']);
            if (!$gallery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);

            /*todo check if file exist */
            if (!$request->hasFile('galleryItem'))
                throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD, "COULDN'T NOT FIND IMAGE");
            $fileName = time().'_'.$request->file('galleryItem')->getClientOriginalName();
            $request->file('galleryItem')->move(public_path('storage/galleries'), $fileName);



            $response = $gallery->update(array_merge($request->except('galleryId'),[
                'galleryItem'=> URL::asset("storage/galleries/$fileName")
            ]));
            if (!$response) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_CREATE);
            return  $this->SUCCESS_RESPONSE("GALLERY UPDATED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
    public function read(): JsonResponse
    {
        try {
            $gallery = Gallery::all();
            if (!$gallery)  throw new ExceptionUtil(ExceptionCase::NOT_SUCCESSFUL);
            return $this->BASE_RESPONSE($gallery);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function readById(ReadByGalleryIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            //todo action
            $gallery = Gallery::where('galleryId', $request['galleryId'])->first();
            if (!$gallery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            return  $this->BASE_RESPONSE($gallery);
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }

    public function delete(ReadByGalleryIdRequest $request): JsonResponse
    {
        try {
            //TODO VALIDATION
            $request->validated($request->all());
            $gallery = Gallery::where('galleryId', $request['galleryId'])->first();
            if (!$gallery) throw new ExceptionUtil(ExceptionCase::UNABLE_TO_LOCATE_RECORD);
            if (!$gallery->delete()) throw new ExceptionUtil(ExceptionCase::SOMETHING_WENT_WRONG);

            return  $this->SUCCESS_RESPONSE("GALLERY DELETED SUCCESSFUL");
        }catch (Exception $ex){
            return $this->ERROR_RESPONSE($ex->getMessage());
        }
    }
}
