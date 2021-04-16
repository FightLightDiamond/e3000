<?php


namespace App\Http\Controllers;


use App\Models\Sentence;
use App\Models\Vocabulary;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

/**
 * Class VocabularyController
 * @package App\Http\Controllers
 */
class VocabularyController
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request)
    {
        $word = $request->get('word');
        return Vocabulary::with('sentences')
            ->when($word, function ($q) use ($word) {
                $q->where('word', 'like', "%{$word}%");
            })
            ->paginate();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $input = $request->only(Vocabulary::getFillable());
        $vocabulary = Vocabulary::create($input);

        $sentencesInput = $request->only('sentences');
        $sentences = [];
        if ($sentencesInput) {
            foreach ($sentencesInput as $sentenceInput) {
                $sentences[] = new Sentence($sentenceInput);
            }
            $vocabulary->sentences()->saveMany($sentences);
        }
        return $vocabulary;
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $input = $request->only(Vocabulary::getFillable());
        return Vocabulary::where('id', $id)->update($input);
    }

    /**
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find($id) {
        return Vocabulary::with('sentences')
            ->find($id);
    }
}
