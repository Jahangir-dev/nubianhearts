<?php
/*
* FilterController.php - Controller file
*
* This file is part of the Filter component.
*-----------------------------------------------------------------------------*/

namespace App\Yantrana\Components\Filter\Controllers;

use App\Yantrana\Base\BaseController; 
use App\Yantrana\Components\Filter\FilterEngine;
use App\Yantrana\Support\CommonUnsecuredPostRequest;
use App\Yantrana\Support\CommonTrait;
use App\SavedSearch;
use Illuminate\Http\Request;

class FilterController extends BaseController 
{     use CommonTrait;
    /**
     * @var  FilterEngine $filterEngine - Filter Engine
     */
    protected $filterEngine;

    /**
      * Constructor
      *
      * @param  FilterEngine $filterEngine - Filter Engine
      *
      * @return  void
      *-----------------------------------------------------------------------*/

    function __construct(FilterEngine $filterEngine)
    {
        $this->filterEngine = $filterEngine;
    }

    /**
     * Get Filter data and show filter view
     *
     * @param obj CommonUnsecuredPostRequest $request
     * 
     * return view
     *-----------------------------------------------------------------------*/
    public function getFindMatches(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->filterEngine->processFilterData($request->all());

        if ($request->ajax()) {
            return $this->responseAction(
                $this->processResponse($processReaction, [], [], true),
                $this->replaceView('filter.find-matches', $processReaction['data'])
            );
        } else {
            //dd($processReaction['data']);
            return $this->loadPublicView('filter.filter', $processReaction['data']);
        }
    }
    public function getSaved()
    {

        $data = $this->filterEngine->getSearches();
        return $this->loadPublicView('filter.saved-search', array($data));
    }
    public function getAllSaved()
    {

        return $this->filterEngine->getSearches();
       
    }
    
    public function editSaved(Request $request)
    {
        $search = SavedSearch::where('id',$request->id)->first();
        return $this->loadPublicView('filter.search-edit', ['userSpecifications'=>$this->getUserSpecificationConfig(),'search'=>$search]);
    }

    public function SavedSearches(CommonUnsecuredPostRequest $request)
    {
        $processReaction = $this->filterEngine->processFilterData($request->all());
        return $this->loadPublicView('filter.search', $processReaction['data']);
    }

    public function saved(Request $request)
    {   
        $data = $request->all();
        $name = SavedSearch::where('name',$request['name'])->get();
        if(count($name) > 0){

            return back()->with('message','Name already exist');
        } else{

        $data['user_id'] = getUserID();
        $saved = SavedSearch::create($data);
        return redirect()->route('user.read.getSaved');
        }
    }

    public function searchUpdate(Request $request,$id)
    {
        $old_name = SavedSearch::find($id);
       
        if($request['name'] != $old_name['name'])
        {
            $name = SavedSearch::where('name',$request['name'])->get();
            if(count($name) > 0 ){

                return back()->with('message','Name already exist');
            } else{
                
                $search->update($request->all());
                return redirect()->route('user.read.getSaved');
            }
        } else {
                
                $search->update($request->all());
                return redirect()->route('user.read.getSaved');
            }
    }

    public function searchDelete($id)
    {
        $search = SavedSearch::find($id);
        $search->delete();
        return redirect()->route('user.read.getSaved');
    }

    public function searchRun($id)
    {
        $search = SavedSearch::where('id',$id)->first()->toArray();
        $processReaction = $this->filterEngine->processFilterData($search);

        return $this->loadPublicView('filter.filter', $processReaction['data']);
    }
}