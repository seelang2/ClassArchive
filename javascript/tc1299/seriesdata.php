<?php
session_start();

// store data in session to make read/write
if (!isset($_SESSION['data'])):


$_SESSION['data'] = array(
	'Series1000' => array( 
			'ModelFX1000' => array(
								array( 'Name' => 'Hydrogen', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Helium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Lithium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Beryllium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelLX1500' => array(
								array( 'Name' => 'Boron', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Carbon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Nitrogen', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Oxygen', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelMX1050' => array(
								array( 'Name' => 'Fluorine', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Neon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Sodium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Magnesium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelPro1000' => array(
								array( 'Name' => 'Aluminum', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Silicon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Phosphorus', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Sulfur', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			)
	),
	'Series2000' => array( 
			'ModelFX2000' => array(
								array( 'Name' => 'Chlorine', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Argon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Potassium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Calcium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelLX2500' => array(
								array( 'Name' => 'Scandium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Titanium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Vanadium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Chromium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelMX2050' => array(
								array( 'Name' => 'Manganese', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Iron', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Cobalt', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Nickel', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelPro2000' => array(
								array( 'Name' => 'Copper', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Zinc', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Gallium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Germanium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			)
	),
	'Series3000' => array( 
			'ModelFX3000' => array(
								array( 'Name' => 'Arsenic', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Selenium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Bromine', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Krypton', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelLX3500' => array(
								array( 'Name' => 'Rubidium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Strontium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Yttrium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Zirconium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelMX3050' => array(
								array( 'Name' => 'Niobium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Molybdenum', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Technetium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Ruthenium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelPro3000' => array(
								array( 'Name' => 'Rhodium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Palladium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Silver', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Cadmium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			)
	),
	'Series4000' => array( 
			'ModelFX4000' => array(
								array( 'Name' => 'Indium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Tin', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Antimony', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Tellurium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelLX4500' => array(
								array( 'Name' => 'Iodine', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Xenon', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Cesium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Barium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelMX4050' => array(
								array( 'Name' => 'Lanthanum', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Cerium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Praseodymium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Neodymium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			),
			'ModelPro4000' => array(
								array( 'Name' => 'Promethium', 'Size' => 'SM', 'Color' => 'Red', 'Type' => 'I', 'Price' => '23.59' ),
								array( 'Name' => 'Samarium', 'Size' => 'Md', 'Color' => 'Blue', 'Type' => 'II', 'Price' => '57.65' ),
								array( 'Name' => 'Europium', 'Size' => 'LG', 'Color' => 'Green', 'Type' => 'III', 'Price' => '45.22' ),
								array( 'Name' => 'Gadolinium', 'Size' => 'XL', 'Color' => 'Gold', 'Type' => 'IV', 'Price' => '98.52' )
			)
	)
);

endif;

// so I don't have to rewrite all the code
$data = $_SESSION['data'];
//print_r($data);
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
						//echo "<pre>" . print_r($item, true) . "</pre>";
						if ($xitem != '' && $xitem == $item['Name']) {
							echo "<mitem>\n";
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
		foreach ($data as $series => $fdata) {
			foreach ($fdata as $model => $subset) {
				foreach ($subset as $itemindex => $item) {	
					if ($item['Name'] == $xitem) {
						$_SESSION['data'][$series][$model][$itemindex]['Name'] = $_REQUEST['Name'];
						$_SESSION['data'][$series][$model][$itemindex]['Size'] = $_REQUEST['Size'];
						$_SESSION['data'][$series][$model][$itemindex]['Color'] = $_REQUEST['Color'];
						$_SESSION['data'][$series][$model][$itemindex]['Type'] = $_REQUEST['Type'];
						$_SESSION['data'][$series][$model][$itemindex]['Price'] = $_REQUEST['Price'];
					
						echo "Ok";
						break 4;
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
		echo 'Fail - item not found';
	break;
	
} // switch








?>