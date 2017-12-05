<?php
/*

*/
session_start();
if (!empty($_GET['reset'])) unset($_SESSION['data']);
// store data in session to make read/write
if (empty($_SESSION['data']))
$_SESSION['data'] = array(
	'Series1000' => array( 
			'ModelFX1000' => array(
								array( 'id' => 1, 'Name' => 'Hydrogen', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 2, 'Name' => 'Helium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 3, 'Name' => 'Lithium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 4, 'Name' => 'Beryllium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelLX1500' => array(
								array( 'id' => 5, 'Name' => 'Boron', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 6, 'Name' => 'Carbon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 7, 'Name' => 'Nitrogen', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 8, 'Name' => 'Oxygen', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelMX1050' => array(
								array( 'id' => 9, 'Name' => 'Fluorine', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 10, 'Name' => 'Neon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 11, 'Name' => 'Sodium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 12, 'Name' => 'Magnesium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelPro1000' => array(
								array( 'id' => 13, 'Name' => 'Aluminum', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 14, 'Name' => 'Silicon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 15, 'Name' => 'Phosphorus', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 16, 'Name' => 'Sulfur', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			)
	),
	'Series2000' => array( 
			'ModelFX2000' => array(
								array( 'id' => 17, 'Name' => 'Chlorine', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 18, 'Name' => 'Argon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 19, 'Name' => 'Potassium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 10, 'Name' => 'Calcium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelLX2500' => array(
								array( 'id' => 21, 'Name' => 'Scandium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 22, 'Name' => 'Titanium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 23, 'Name' => 'Vanadium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 24, 'Name' => 'Chromium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelMX2050' => array(
								array( 'id' => 25, 'Name' => 'Manganese', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 26, 'Name' => 'Iron', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 27, 'Name' => 'Cobalt', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 28, 'Name' => 'Nickel', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelPro2000' => array(
								array( 'id' => 29, 'Name' => 'Copper', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 30, 'Name' => 'Zinc', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 31, 'Name' => 'Gallium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 32, 'Name' => 'Germanium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			)
	),
	'Series3000' => array( 
			'ModelFX3000' => array(
								array( 'id' => 33, 'Name' => 'Arsenic', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 34, 'Name' => 'Selenium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 35, 'Name' => 'Bromine', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 36, 'Name' => 'Krypton', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelLX3500' => array(
								array( 'id' => 37, 'Name' => 'Rubidium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 38, 'Name' => 'Strontium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 39, 'Name' => 'Yttrium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 40, 'Name' => 'Zirconium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelMX3050' => array(
								array( 'id' => 41, 'Name' => 'Niobium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 42, 'Name' => 'Molybdenum', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 43, 'Name' => 'Technetium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 44, 'Name' => 'Ruthenium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelPro3000' => array(
								array( 'id' => 45, 'Name' => 'Rhodium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 46, 'Name' => 'Palladium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 47, 'Name' => 'Silver', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 48, 'Name' => 'Cadmium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			)
	),
	'Series4000' => array( 
			'ModelFX4000' => array(
								array( 'id' => 49, 'Name' => 'Indium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 50, 'Name' => 'Tin', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 51, 'Name' => 'Antimony', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 52, 'Name' => 'Tellurium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelLX4500' => array(
								array( 'id' => 53, 'Name' => 'Iodine', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 54, 'Name' => 'Xenon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 55, 'Name' => 'Cesium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 56, 'Name' => 'Barium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelMX4050' => array(
								array( 'id' => 57, 'Name' => 'Lanthanum', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 58, 'Name' => 'Cerium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 59, 'Name' => 'Praseodymium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 60, 'Name' => 'Neodymium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelPro4000' => array(
								array( 'id' => 61, 'Name' => 'Promethium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'id' => 62, 'Name' => 'Samarium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'id' => 63, 'Name' => 'Europium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'id' => 64, 'Name' => 'Gadolinium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			)
	)
);

// so I don't have to rewrite all the code
$data = $_SESSION['data'];

$xseries= 'ALL';
$xmodel='ALL';
$xmode = 'SERIES';
if (isset($_REQUEST['mode']) && $_REQUEST['mode'] != '') $xmode = strtoupper($_REQUEST['mode']);
if (isset($_REQUEST['series']) && $_REQUEST['series'] != '') $xseries = $_REQUEST['series'];
if (isset($_REQUEST['model']) && $_REQUEST['model'] != '') $xmodel = $_REQUEST['model'];
if (isset($_REQUEST['item']) && $_REQUEST['item'] != '') $xitem = $_REQUEST['item']; else $xitem = '';

// echo "<p>$xmode, $xseries, $xmodel</p>";


/*

<select name="menu1" id="menu1">
  <option value="item1val">item1</option>
  <option value="item2val">item2</option>
</select>

*/

// to simulate latency
//mt_srand ((double) microtime() * 1000000);
mt_srand(crc32(microtime()));
usleep(mt_rand(25000, 400000) * 3);


switch ($xmode)
{
	case 'SERIES':
		echo '<select name="menu1" id="menu1" size="6"><option value="ALL">Please Select One</option>';

		// gets all series names (and arrays)
		$fdata = $data;
		foreach ($fdata as $key => $value) {
			echo "<option value=\"$key\">$key</option>\n";
			//echo "<p>$key, $value</p>";
		}
		echo '</select>';
	break;

	case 'MODEL':
		echo '<select name="menu2" id="menu2" size="6"><option value="ALL">Please Select One</option>';
		if (strtoupper($xseries) == 'ALL') {
			// gets all model names and arrays for all series
			foreach ($data as $fdata) {
				foreach ($fdata as $key=>$value) {
					echo "<option value=\"$key\">$key</option>\n";
					//echo "<p>$key, $value</p>";
				}
			}
		} else {
			// gets all model names (and arrays) for a given series
			$fdata = $data[$xseries];
			foreach ($fdata as $key => $value) {
				echo "<option value=\"$key\">$key</option>\n";
				//echo "<p>$key, $value</p>";
			}
		}
		echo '</select>';
	break;

	case 'DATA':

		header("Content-Type: text/xml");
		echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\n";
		echo "<itemlist>\n";

		if (strtoupper($xseries) == 'ALL' && strtoupper($xmodel) == 'ALL' && strtoupper($xitem) != '') {

			// gets a single item matching item param (mode=data&series=all&model=all&item=xxx)
			foreach ($data as $fdata) {
				foreach ($fdata as $subset) {
					foreach ($subset as $item) {	
						echo "<pre>" . print_r($item, true) . "</pre>";
						if ($xitem != '' && $xitem == $item['id']) {
							echo "<mitem>\n";
							echo "<id>{$item['id']}</id>\n";
							echo "<name>{$item['Name']}</name>\n";
							echo "<size>{$item['Size']}</size>\n";
							echo "<color>{$item['Color']}</color>\n";
							echo "<type>{$item['Type']}</type>\n";
							echo "<price>{$item['Price']}</price>\n";
							echo "</mitem>\n";
						}
					}
				}
			}

		} else if (strtoupper($xseries) == 'ALL' && strtoupper($xmodel) == 'ALL' && strtoupper($xitem) == '') {

			// gets all items, period (mode=data&series=all&model==all)
			foreach ($data as $fdata) {
				foreach ($fdata as $subset) {
					foreach ($subset as $item) {	
						//echo "<pre>" . print_r($item, true) . "</pre>";
							echo "<mitem>\n";
							echo "<id>{$item['id']}</id>\n";
							echo "<name>{$item['Name']}</name>\n";
							echo "<size>{$item['Size']}</size>\n";
							echo "<color>{$item['Color']}</color>\n";
							echo "<type>{$item['Type']}</type>\n";
							echo "<price>{$item['Price']}</price>\n";
							echo "</mitem>\n";
					}
				}
			}


		} else if (strtoupper($xseries) != 'ALL' && strtoupper($xmodel) == 'ALL') {

			// gets all item arrays for a given series (mode=data&series=xxx&model=all)
			$fdata = $data[$xseries];
			foreach ($fdata as $subset) {
				foreach ($subset as $item) {	
					//echo "<pre>" . print_r($item, true) . "</pre>";
						echo "<mitem>\n";
						echo "<id>{$item['id']}</id>\n";
						echo "<name>{$item['Name']}</name>\n";
						echo "<size>{$item['Size']}</size>\n";
						echo "<color>{$item['Color']}</color>\n";
						echo "<type>{$item['Type']}</type>\n";
						echo "<price>{$item['Price']}</price>\n";
						echo "</mitem>\n";
				}
			}

		} else if (strtoupper($xmodel) == 'ALL') {
			// not used
		} else if (strtoupper($xmodel) != 'ALL') {
			// gets all item arrays for a given model
			foreach ($data as $fdata) {
				foreach ($fdata as $key => $value) {
					if ($key == $xmodel) {
						foreach ($value as $item) {	
							//echo "<pre>" . print_r($item, true) . "</pre>";
						echo "<mitem>\n";
						echo "<id>{$item['id']}</id>\n";
						echo "<name>{$item['Name']}</name>\n";
						echo "<size>{$item['Size']}</size>\n";
						echo "<color>{$item['Color']}</color>\n";
						echo "<type>{$item['Type']}</type>\n";
						echo "<price>{$item['Price']}</price>\n";
						echo "</mitem>\n";
						}
					}
				}
			}
		
		}

/*
		foreach ($recordset as $key => $value) {
			echo "<item>\n<$key>$value</$key>\n
			<value>$value</value>\n
			<value>$value</value>\n
			<value>$value</value>\n
			<value>$value</value>\n
			</item>\n";
		}
*/

		echo "</itemlist>\n";
	
	break;
	
	case 'EDIT':
		if (empty($xitem)) {
			echo 'Fail - no item present';
			break;
		}
		
		if (empty($_REQUEST['Name']) ||
		    empty($_REQUEST['Size']) ||
		    empty($_REQUEST['Color']) ||
		    empty($_REQUEST['Type']) ||
		    empty($_REQUEST['Price'])
		   ) {
		 	echo 'Fail - missing field';
			break;  
		}

		// loop through all items
		foreach ($data as $fdata) {
			foreach ($fdata as $subset) {
				foreach ($subset as $item) {	
					if ($item['id'] == $xitem) {
						$_SESSION['data'][$fdata][$subset][$item]['Name'] = $_REQUEST['Name'];
						$_SESSION['data'][$fdata][$subset][$item]['Size'] = $_REQUEST['Size'];
						$_SESSION['data'][$fdata][$subset][$item]['Color'] = $_REQUEST['Color'];
						$_SESSION['data'][$fdata][$subset][$item]['Type'] = $_REQUEST['Type'];
						$_SESSION['data'][$fdata][$subset][$item]['Price'] = $_REQUEST['Price'];
					
					}
					
					/*
					//echo "<pre>" . print_r($item, true) . "</pre>";
						echo "<mitem>\n";
						echo "<name>{$item['Name']}</name>\n";
						echo "<size>{$item['Size']}</size>\n";
						echo "<color>{$item['Color']}</color>\n";
						echo "<type>{$item['Type']}</type>\n";
						echo "<price>{$item['Price']}</price>\n";
						echo "</mitem>\n";
					*/
				}
			}
		}
		echo 'Ok';
	break;
	
} // switch








?>