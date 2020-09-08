<?php
$path = realpath(".")."\\pdf";
$file = $path."\\".$data["material"].".pdf";
$arr  = [];

if ($data['material'] != "tents") {
	foreach($data["dancers"] as $dancer) {
		if (!empty($dancer->table_number) && !empty($dancer->seat_number)) {
			$seat     = "t{$dancer->table_number}s{$dancer->seat_number}";
			$fullName = "{$dancer->first}\x0d{$dancer->last}";

			if ($data["material"] == "cards") {
				$arr[$seat."_front"] = $fullName;
				$arr[$seat."_back"]  = $fullName;
			}
			else {
				$arr[$seat] = $fullName;
			}
		}
	}
}

$pdf = new FPDM($file);
$pdf->Load($arr, true);
$pdf->Merge();
$pdf->Output("I", $data['material'].".pdf");
?>