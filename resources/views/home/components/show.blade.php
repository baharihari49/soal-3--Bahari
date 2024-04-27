@extends('layouts.mainLayouts')

@section('section')
<h3 class="text-2xl font-semibold mb-3">Detail product</h3>
<section class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-32">
    <div class="py-5 px-5">
        <img id="image-preview" class="w-[30%]" src="{{ $data->image ? asset('storage/images/' . $data->image) : 'https://res.cloudinary.com/du0tz73ma/image/upload/v1700279273/building_z7thy7.png' }}" alt="Image Preview">
    </div>
        <div style="width: 40%" class="px-5">
            <form  action="/update/{{$data->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                 <table class="w-full">
                    <tr class="">
                        <input onchange="previewImage(event)" style="width: 60%" class="block text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" type="file" name="image">
                    </tr>
                    <tr class="">
                        <td class="py-2">Transaction code</td>
                        <td> : <input class="border-none py-1 rounded-md" type="text" value="{{$data->code}}" disabled></td>
                    </tr>
                    <tr>
                        <td class="py-2">Name</td>
                        <td> : <input autofocus class="border-none py-1 rounded-md" type="text" name="name" value="{{$data->name}}"></td>
                    </tr>
                    <tr>
                        <td class="py-2">Stock</td>
                        <td> : <input class="border-none py-1 rounded-md" type="text" name="stok" value="{{$data->stok}}"></td>
                    </tr>
                    <tr>
                        <td class="py-2">Price</td>
                        <td> : <input class="border-none py-1 rounded-md" type="text" name="price" value="{{$data->price}}"></td>
                    </tr>
                    <tr>
                        <td class="py-2">Category</td>
                        <td>
                            : <select class="border-none py-1 rounded-md" name="category">
                                <option disabled>Select category</option>
                                <option value="Kategori 1" <?php echo ($data->category == 'Kategori 1') ? 'selected' : ''; ?>>Kategori 1</option>
                                <option value="Kategori 2" <?php echo ($data->category == 'Kategori 2') ? 'selected' : ''; ?>>Kategori 2</option>
                                <option value="Kategori 3" <?php echo ($data->category == 'Kategori 3') ? 'selected' : ''; ?>>Kategori 3</option>
                            </select>
                        </td>
                    </tr>


                </table>
                <hr style="margin-top: 10px; margin-bottom: 20px; width: 355%" class="">
                <nav style="margin-bottom: 20px">
                    <div class="flex items-center gap-3">
                        <a href="/">
                            <button type="button" class="flex items-center justify-center border text-black focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                Back
                            </button>
                        </a>
                        <button class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2">Save</button>
                </form>
        </div>
    </nav>
</section>


<script>
    function previewImage(event) {
        const preview = document.getElementById('image-preview');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = 'https://res.cloudinary.com/du0tz73ma/image/upload/v1700279273/building_z7thy7.png';
        }
    }
</script>

@endsection
