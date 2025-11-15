<form action="{{ route('consultation.storeUpload', $consultation->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="file">Choose a file:</label>
    <input type="file" name="file" id="file" required>
    
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Upload
    </button>
</form>
