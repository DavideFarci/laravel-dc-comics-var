<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    private $validations = [
        'title' => 'required|string|min:5|max:50',
        'description' => 'required|string',
        'thumb' => 'required|string|min:5|max:255',
        'price' => 'required|integer|min:1|max:250',
        'series' => 'required|string|max:50',
        'sale_date' => 'required|date',
        'type' => 'required|string|max:50',
        // NON possiamo mettere un tetto massimo più ALTO di quello dal database MA possiamo volendo, metterlo più BASSO
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comic::paginate(6); // SELECT * FROM `pastas`

        // dd($comics);

        return view('comics.index', compact('comics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare i dati 
        $request->validate($this->validations);

        $data = $request->all();
        // Salvare i dati nel database
        $newComic = new Comic();
        $newComic->title = $data['title'];
        $newComic->description = $data['description'];
        $newComic->thumb = $data['thumb'];
        $newComic->price = $data['price'];
        $newComic->series = $data['series'];
        $newComic->sale_date = $data['sale_date'];
        $newComic->type = $data['type'];
        $newComic->save();

        // return 'commentare se serve debuggare';
        // $newComic = Comic::create($data);

        return redirect()->route('comics.show', ['comic' => $newComic->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comic)
    {
        return view('comics.show', compact('comic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {
        return view('comics.edit', compact('comic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        //validare i dati
        $request->validate($this->validations);


        $data = $request->all();
        //aggiornare i dati nel db
        $comic->title = $data['title'];
        $comic->description = $data['description'];
        $comic->thumb = $data['thumb'];
        $comic->price = $data['price'];
        $comic->series = $data['series'];
        $comic->sale_date = $data['sale_date'];
        $comic->type = $data['type'];
        $comic->update();

        // return redirect()->route('comics.show', ['comic' => $newComic->id]);
        // Equivalente
        return to_route('comics.show', ['comic' => $comic->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        $comic->delete();
        return to_route('comics.index')->with('delete_success', $comic);
    }

    public function restore($id)
    {
        Comic::withTrashed()->where('id', $id)->restore();

        $comic = Comic::find($id);

        return to_route('comics.index')->with('restore_success', $comic);
    }

    public function trashed()
    {
        // $comics = Comic::all(); // SELECT * FROM `comics`
        $trashedComics = Comic::onlyTrashed()->paginate(6);

        return view('comics.trashed', compact('trashedComics'));
    }

    public function harddelete($id)
    {
        $comic = Comic::withTrashed()->find($id);
        $comic->forceDelete();

        return to_route('comics.trashed')->with('delete_success', $comic);
    }
}
