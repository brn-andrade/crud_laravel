<?php

namespace App\Http\Controllers;

use App\Entities\Nerd;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\NerdCreateRequest;
use App\Http\Requests\NerdUpdateRequest;
use App\Repositories\NerdRepository;
use App\Validators\NerdValidator;


class NerdsController extends Controller
{

    /**
     * @var NerdRepository
     */
    protected $repository;

    /**
     * @var NerdValidator
     */
    protected $validator;

    public function __construct(NerdRepository $repository, NerdValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $nerds = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $nerds,
            ]);
        }

        return view('nerds.index', compact('nerds'));
    }

    public function create()
    {
        return view('nerds.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  NerdCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(NerdCreateRequest $request)
    {
        //dd($request->all());
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $nerd = $this->repository->create($request->all());

            $response = [
                'message' => 'Nerd criado com sucesso!',
                'data'    => $nerd->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nerd = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $nerd,
            ]);
        }

        return view('nerds.show', compact('nerd'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get nerd
        $nerd = $this->repository->find($id);


        return view('nerds.edit', compact('nerd'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  NerdUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update($id)
    {

        $nerd = $this->repository->find($id);
        $nerd->name = Input::get('name');
        $nerd->email = Input::get('email');
        $nerd->nerd_level = Input::get('nerd_level');
        $nerd->save();


        Session::flash('message', 'Nerd atualizado com sucesso!');
        return Redirect::to('nerds');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Nerd Deletado com sucesso!',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Nerd deletado com sucesso!!!');
    }
}
