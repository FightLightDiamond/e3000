<?php


namespace App\Http\Controllers;


use App\Models\Sentence;
use Illuminate\Support\Facades\Request;

/**
 * Class SentenceController
 * @package App\Http\Controllers
 */
class SentenceController
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $input = $request->only(Sentence::getFillable());
        return Sentence::create($input);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $input = $request->only(Sentence::getFillable());
        return Sentence::where('id', $id)->update($input);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        return Sentence::where('id', $id)->delete();
    }
}
