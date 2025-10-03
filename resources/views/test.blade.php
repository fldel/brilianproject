<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Beasiswa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Tambah Beasiswa</h1>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('scholarships.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nama Beasiswa:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="description" required></textarea><br><br>

    <div id="category-wrapper">
        <div class="category-select">
        <label>Kategori:</label><br>
            <select name="categories[]" class="form-control" style="min-width:200px; height:40px;">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        <br>
        </div>
    </div>
    <br>
    <button type="button" onclick="addCategory()">+ Tambah Kategori</button>
    <br>

        <label>Gambar:</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <label>Link:</label><br>
        <input type="url" name="link"><br><br>

        <label>Tersedia?</label>
        <input type="checkbox" name="is_available" checked><br><br>

        <label>Mulai:</label><br>
        <input type="datetime-local" name="starts_at"><br><br>

        <label>Selesai:</label><br>
        <input type="datetime-local" name="ends_at"><br><br>

        <button type="submit">Simpan</button>
    </form>

<script>
function addCategory() {
    let wrapper = document.getElementById("category-wrapper");
    let newSelect = document.querySelector(".category-select").cloneNode(true);
    wrapper.appendChild(newSelect);
}
</script>
</body>
</html>
