<?php
/**
 * Tools for country class.
 *
 * @copyright YetiForce Sp. z o.o
 * @license   YetiForce Public License 3.0 (licenses/LicenseEN.txt or yetiforce.com)
 * @author    Mariusz Krzaczkowski <m.krzaczkowski@yetiforce.com>
 */

namespace App\Fields;

/**
 * Country class.
 */
class Country
{
	/**
	 * Get all country.
	 *
	 * @param bool|string $type
	 *
	 * @return array
	 */
	public static function getAll($type = false)
	{
		if (\App\Cache::has('Country|getAll', $type)) {
			return \App\Cache::get('Country|getAll', $type);
		}
		$select = ['code', 'id', 'name'];
		if ($type && $type === 'uitype') {
			$select = ['name', 'code', 'id'];
		}
		$query = new \App\Db\Query();
		$query->select($select)->from('u_#__countries')->where(['status' => 0])->orderBy('sortorderid');
		if ($type) {
			$query->andWhere([$type => 0]);
		}
		$rows = $query->createCommand()->queryAllByGroup(1);
		\App\Cache::save('Country|getAll', $type, $rows);

		return $rows;
	}

	/**
	 * Return correct key value of given country in user language.
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	public static function findCountryName(string $value): string
	{
		if (empty($value)) {
			return '';
		}
		if (($userLanguage = \App\Language::getLanguage()) !== ($defaultLanguage = \App\Config::main('default_language'))) {
			$secondLanguage = array_map('strtolower', \App\Language::getFromFile('Other/Country', $defaultLanguage)['php']);
		}
		$firstLanguage = array_map('strtolower', \App\Language::getFromFile('Other/Country', $userLanguage)['php']);
		$countryName = ucwords(trim($value));
		$formattedCountryName = strtolower($countryName);
		if (empty($firstLanguage[$countryName])) {
			if (\in_array($formattedCountryName, $firstLanguage)) {
				$countryName = \array_search($formattedCountryName, $firstLanguage);
			} elseif (!empty($secondLanguage) && \in_array($formattedCountryName, $secondLanguage)) {
				$countryName = \array_search($formattedCountryName, $secondLanguage);
			}
		}
		return $countryName;
	}
}
