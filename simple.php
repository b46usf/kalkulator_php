<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kalkulator Sederhana dengan PHP</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">
	<?php 
	$hasil = ""; 
	$bil1 = $bil2 = ""; 
	$errors = []; 

	function hitung($bil1, $bil2, $operasi) {
		switch ($operasi) {
			case 'tambah': return $bil1 + $bil2;
			case 'kurang': return $bil1 - $bil2;
			case 'kali': return $bil1 * $bil2;
			case 'bagi': return ($bil2 != 0) ? $bil1 / $bil2 : null;
			default: return null;
		}
	}

	if(isset($_POST['hitung'])){
		// Mengambil dan memfilter input agar mendukung angka desimal
		$bil1 = filter_input(INPUT_POST, 'bil1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$bil2 = filter_input(INPUT_POST, 'bil2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
		$operasi = isset($_POST['operasi']) ? htmlspecialchars($_POST['operasi']) : null;

		// Validasi input
		if(empty($bil1)) $errors[] = "Bilangan pertama tidak boleh kosong.";
		if(empty($bil2)) $errors[] = "Bilangan kedua tidak boleh kosong.";
		if(!is_numeric($bil1) || !is_numeric($bil2)) $errors[] = "Input harus berupa angka.";
		if($bil2 == 0 && $operasi === 'bagi') $errors[] = "Tidak bisa membagi dengan nol.";

		if(empty($errors)) {
			// Pastikan input bilangan desimal
			$bil1 = floatval($bil1);
			$bil2 = floatval($bil2);
			$hasil = hitung($bil1, $bil2, $operasi);
			$hasil = ($hasil !== null) ? number_format($hasil, 2) : "Operasi tidak valid.";
		}
	}
	?>
	<div class="bg-white p-6 rounded-lg shadow-lg w-80">
		<h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">KALKULATOR</h2>
		<a class="text-sm text-blue-500 hover:text-blue-700 mb-4 block text-center" href="https://www.youtube.com/c/imamdeveloper">YOUTUBE/imamdeveloper</a>
		
		<form method="post" action="" class="space-y-4">
			<div>
				<label for="bil1" class="block text-gray-700">Bilangan Pertama</label>
				<input type="number" id="bil1" name="bil1" step="any" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" 
					placeholder="Masukkan Bilangan Pertama" value="<?php echo htmlspecialchars($bil1); ?>" required>
			</div>
			<div>
				<label for="bil2" class="block text-gray-700">Bilangan Kedua</label>
				<input type="number" id="bil2" name="bil2" step="any" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" 
					placeholder="Masukkan Bilangan Kedua" value="<?php echo htmlspecialchars($bil2); ?>" required>
			</div>
			<div>
				<label for="operasi" class="block text-gray-700">Operasi</label>
				<select id="operasi" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" name="operasi" required>
					<option value="tambah" <?php if(isset($operasi) && $operasi == 'tambah') echo 'selected'; ?>>+</option>
					<option value="kurang" <?php if(isset($operasi) && $operasi == 'kurang') echo 'selected'; ?>>-</option>
					<option value="kali" <?php if(isset($operasi) && $operasi == 'kali') echo 'selected'; ?>>x</option>
					<option value="bagi" <?php if(isset($operasi) && $operasi == 'bagi') echo 'selected'; ?>>/</option>
				</select>
			</div>
			<button type="submit" name="hitung" class="w-full py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Hitung</button>
		</form>

		<?php if(!empty($errors)) { ?>
			<div class="mt-4 text-red-500">
				<ul>
					<?php foreach($errors as $error) { ?>
						<li><?php echo htmlspecialchars($error); ?></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>
		
		<input type="text" value="<?php echo htmlspecialchars($hasil ?: "0"); ?>" class="w-full p-3 border border-gray-300 rounded-lg mt-4 text-center text-xl font-bold text-gray-800" readonly>
	</div>
</body>
</html>