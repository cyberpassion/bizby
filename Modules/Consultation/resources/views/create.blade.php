<!-- resources/views/consultation/create.blade.php -->

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
    
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">
        Create Consultation
    </h2>

    <form method="POST"
          action="{{ route('consultation.store') }}">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input 
                name="patient_name" 
                label="Patient Name" 
                placeholder="Enter patient name" 
                class="ac-name w-full"
                :mandatory="true"
            />

            <x-input 
				type="number"
                name="consultation_with" 
                label="CW" 
                placeholder="Enter CW" 
                class="ac-name w-full"
                :mandatory="true"
            />

        </div>

        <!-- Submit Button -->
        <button type="submit"
                class="w-full md:w-auto mt-4 px-6 py-2 bg-blue-600 text-white font-semibold rounded-md 
                       hover:bg-blue-700 active:bg-blue-800 transition-all shadow-sm">
            Submit
        </button>

    </form>
</div>
