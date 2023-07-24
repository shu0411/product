<?php
namespace unidolDB;
spl_autoload_register(function ($class) {
		$parts = explode('\\', $class);
		$class = end($parts);
		include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
});

/**
 * 汎用的な関数クラス
 * @author shu32
 *
 */
class Functions{
	const HTML_CHARACTER_SET = 'UTF-8';

	/**
	 * 特殊文字をHTMLエンティティに変換する
	 * @param  $str string 変換前文字
	 * @return string 変換後文字
	 */
	function entity_str($str) {
		return htmlspecialchars($str, ENT_QUOTES, self::HTML_CHARACTER_SET);
	}

	/**
	 * 特殊文字をHTMLエンティティに変換する(2次元配列の値)
	 * @param $assoc_array array 変換前配列
	 * @return array 変換後配列
	 */
	function entity_assoc_array($assoc_array) {
			foreach ($assoc_array as $key => $value) {
					foreach ($value as $keys => $values) {
							// 特殊文字をHTMLエンティティに変換
							$assoc_array[$key][$keys] = self::entity_str($values);
					}
			}
			return $assoc_array;
	}
}