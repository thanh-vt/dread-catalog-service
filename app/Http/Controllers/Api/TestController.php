<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\Console\Output\ConsoleOutput;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        //
    }

    //
    public function hello($name, $year_of_birth): JsonResponse
    {
        $x=5;
        $out = new ConsoleOutput();
        $out->writeln($x);
        $data = array();
        $data['message'] = "Hello " . $name . ", who was born in " . $year_of_birth;
        return response()->json($data, 200);
    }

    public function goodbye($name, $year_of_birth): string
    {
        return response()->json("Good Bye " . $name . ", who was born in " . $year_of_birth, 204);
    }
}
