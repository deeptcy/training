<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pages; 

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $pages = Pages::all();	
        $pages = Pages::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get();
	
        return view('pagelist', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   return view('pageadd');
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
    public function edit(Request $request, $id)
    { 
	
	 $page = Pages::find($id);
        return view('pageedit', compact('page'));        
	
		//return view('pageedit', compact('pages'));
    }
	
	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pageadd(Request $request)
    { 
		 return view('pageadd');
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
		$data =$request->all();		
		$request->validate([
            'pagetitle'=>'required'
        ]);

        $page = Pages::find($id);
        $page->pagetitle =  $request->get('pagetitle');
        $page->pagecontent =  $request->get('pagecontent');		
        $page->metaTitle =  $request->get('metaTitle');
        $page->metaDesc =  $request->get('metaDesc');
        $page->metaKeywords =  $request->get('metaKeywords');
        $page->canonical =  $request->get('canonical');
        $page->robots =  $request->get('robots');        
       
		
		
		
        $page->save();

        return redirect('/pages')->with('success', 'page updated!');
			
			
			
			
print_r($data);			
		print_r('postt');
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
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lan_DEL()
    {   $id =1; 
        $page = Pages::find($id);
		
		return view('lan', compact('page'));        
    } 
	
	
	
	
	public function omos()
    {   
		$page = Pages::where('pagekey', '=', 'om-os')->get()->toarray(); 
		return view('omos', ['page' => $page[0]]);
	}
	

	
	public function vilkaarogansvar() 
    {   
		$page = Pages::where('pagekey', '=', 'vilkaar-og-ansvar')->get()->toarray(); 
		return view('vilkaarogansvar', ['page' => $page[0]]);
	}
	
	public function cookiepolitik()
    {   
		$page = Pages::where('pagekey', '=', 'cookiepolitik')->get()->toarray(); 
		return view('cookiepolitik', ['page' => $page[0]]);
	}
	
	
	public function oftestilledespoergsmaal()
    {   
		$page = Pages::where('pagekey', '=', 'ofte-stillede-spoergsmaal')->get()->toarray(); 
		return view('oftestilledespoergsmaal', ['page' => $page[0]]);
	}
	
	public function persondatapolitik()
    {   
		$page = Pages::where('pagekey', '=', 'persondatapolitik')->get()->toarray(); 
		return view('persondatapolitik', ['page' => $page[0]]);
	}
	
	public function boliglaan()
    {   
		$page = Pages::where('pagekey', '=', 'boliglaan')->get()->toarray(); 
		return view('boliglaan', ['page' => $page[0]]);
	}
	
	public function huslaan()
    {   
		$page = Pages::where('pagekey', '=', 'huslaan')->get()->toarray(); 
		return view('huslaan', ['page' => $page[0]]);
	}
		
	public function laanifrivaerdi()
    {   
		$page = Pages::where('pagekey', '=', 'laan-i-frivaerdi')->get()->toarray(); 
		return view('laanifrivaerdi', ['page' => $page[0]]);
	}	

	public function pantebrevslaan()
    {   
		$page = Pages::where('pagekey', '=', 'pantebrevslaan')->get()->toarray(); 
		return view('pantebrevslaan', ['page' => $page[0]]);
	}
	
	public function tvangsauktion()
    {   
		$page = Pages::where('pagekey', '=', 'tvangsauktion')->get()->toarray(); 
		return view('tvangsauktion', ['page' => $page[0]]);
	}
	public function haandvaerkertilbud()
    {   
		$page = Pages::where('pagekey', '=', 'haandvaerkertilbud')->get()->toarray(); 
		return view('haandvaerkertilbud', ['page' => $page[0]]);
	}
	public function leksikon()
    {   
		$page = Pages::where('pagekey', '=', 'leksikon')->get()->toarray(); 
		return view('leksikon', ['page' => $page[0]]);
	}
	
	public function kontakt()
    {   
		$page = Pages::where('pagekey', '=', 'kontakt')->get()->toarray(); 
		return view('kontakt', ['page' => $page[0]]);
	}
	
	public function saadanfungererdet()
    {   
		$page = Pages::where('pagekey', '=', 'saadan-fungerer-det')->get()->toarray(); 
		return view('saadanfungererdet', ['page' => $page[0]]);
	}
	
	
	public function nedsparingslaan()
    {   
		$page = Pages::where('pagekey', '=', 'nedsparingslaan')->get()->toarray(); 
		return view('nedsparingslaan', ['page' => $page[0]]);
	}
	
	
	
	/*

	public function omos()
    {   $id =1; 
        $page = Pages::find($id);
		
		return view('omos', compact('page'));        
    }
	
	public function lanerdu()
    {   $id =2; 
        $page = Pages::find($id);
		
		return view('lanerdu', compact('page'));        
    }
	
	public function stillede()
    {   $id =3; 	
        $page = Pages::find($id);
	
		return view('stillede', compact('page'));        
    }
	

	public function saadanforegaardet()
    {   $id =4; 
        $page = Pages::find($id);		
		return view('saadan-foregaar-det', compact('page'));        
    }
	
	public function cookiepolitikt()
    {   $id =5; 
        $page = Pages::find($id);		
		return view('cookie-politikt', compact('page'));        
    }
	
	public function vilkaarogansvar()
    {   $id =6; 	
        $page = Pages::find($id);	
		return view('vilkaar-og-ansvar', compact('page'));        
    }
	
	*/
	
	
	
}