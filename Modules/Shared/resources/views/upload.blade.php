<form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="file">Choose a file:</label>
    <input type="file" name="file" id="file" required>

    <!-- Prefilled reference_id -->
    <input type="text" name="reference_id" id="reference_id" 
           value="{{ $referenceId ?? '' }}" readonly>

    <!-- Prefilled file_key -->
    <input type="text" name="file_key" id="file_key" 
           value="{{ $fileKey ?? '' }}" readonly>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
        Upload
    </button>
</form>
