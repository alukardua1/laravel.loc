<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

namespace App\Observers;

use App\Models\Anime;
use App\Traits\FunctionsTrait;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;


/**
 * Class AnimeObserver
 *
 * @package App\Observers
 */
class AnimeObserver
{
	use FunctionsTrait;

	/**
	 * @param  Anime  $anime
	 */
	public function updating(Anime $anime)
	{
		$anime->url = Str::slug($anime->title);
		$anime->posted_at = request()->posted_at ? true : false;
		$anime->description = $anime->title;
		$anime->keywords = $this->seoKeywords($anime->content);
	}

	/**
	 * @param  Anime  $anime
	 *
	 * @todo Не забыть сменить $anime->metatitle, $anime->description, дописать вариант логов изменения поста
	 */
	public function creating(Anime $anime)
	{
		$anime->url = Str::slug($anime->title);
		$anime->metatitle = $anime->title;
		$anime->aired_season = Carbon::parse($anime->aired_on)->format('Y');
		$anime->keywords = $this->seoKeywords($anime->content);
		$anime->description = $anime->title;
	}

	/**
	 * @param  Anime  $anime
	 *
	 * @return RedirectResponse
	 */
	public function updated(Anime $anime): RedirectResponse
	{
		return redirect()->route('admin.anime')->send();
	}

	/**
	 * Создает ключевые слова для поста
	 *
	 * @param       $contents
	 * @param  int  $symbol
	 * @param  int  $words
	 *
	 * @return false|string
	 */
	private function seoKeywords($contents, $symbol = 5, $words = 35)
	{
		$contents = @preg_replace(
			["'<[\/\!]*?[^<>]*?>'si", "'([\r\n])[\s]+'si", "'&[a-z0-9]{1,6};'si", "'( +)'si"],
			["", "\\1 ", " ", " "],
			strip_tags($contents)
		);
		$rearray = [
			"~",
			"!",
			"@",
			"#",
			"$",
			"%",
			"^",
			"&",
			"*",
			"(",
			")",
			"_",
			"+",
			"`",
			'"',
			"№",
			";",
			":",
			"?",
			"-",
			"=",
			"|",
			"\"",
			"\\",
			"/",
			"[",
			"]",
			"{",
			"}",
			"'",
			",",
			".",
			"<",
			">",
			"\r\n",
			"\n",
			"\t",
			"«",
			"»",
		];
		$adjectivearray = [
			"ые",
			"ое",
			"ие",
			"ий",
			"ая",
			"ый",
			"ой",
			"ми",
			"ых",
			"ее",
			"ую",
			"их",
			"ым",
			"как",
			"для",
			"что",
			"или",
			"это",
			"этих",
			"всех",
			"вас",
			"они",
			"оно",
			"еще",
			"когда",
			"где",
			"эта",
			"лишь",
			"уже",
			"вам",
			"нет",
			"если",
			"надо",
			"все",
			"так",
			"его",
			"чем",
			"при",
			"даже",
			"мне",
			"есть",
			"только",
			"очень",
			"сейчас",
			"точно",
			"обычно",
		];

		$contents = @str_replace($rearray, " ", $contents);
		$keywordCache = @explode(" ", $contents);
		$rearray = [];

		foreach ($keywordCache as $word) {
			if (strlen($word) >= $symbol && !is_numeric($word)) {
				$adjective = substr($word, -2);
				if (!in_array($adjective, $adjectivearray, true) && !in_array($word, $adjectivearray, true)) {
					$rearray[$word] = (array_key_exists($word, $rearray)) ? ($rearray[$word] + 1) : 1;
				}
			}
		}
		@arsort($rearray);
		$keywordCache = @array_slice($rearray, 0, $words);
		$keywords = "";
		foreach ($keywordCache as $word => $count) {
			$keywords .= "," . $word;
		}

		return substr($keywords, 1);
	}
}
