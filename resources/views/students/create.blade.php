<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-6">
                <h2 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Student Management
                </h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="block py-3 px-6 hover:bg-gray-700 transition">
                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                </a>
                <a href="{{ route('students.index') }}" class="block py-3 px-6 bg-gray-800 hover:bg-gray-700 transition">
                    <i class="fas fa-user-graduate mr-2"></i> Students
                </a>
                <a href="{{ route('courses.index') }}" class="block py-3 px-6 hover:bg-gray-700 transition">
                    <i class="fas fa-book mr-2"></i> Courses
                </a>
                <a href="{{ route('enrollments.index') }}" class="block py-3 px-6 hover:bg-gray-700 transition">
                    <i class="fas fa-clipboard-list mr-2"></i> Enrollments
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4">
                    <div class="flex items-center">
                        <a href="{{ route('students.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1 class="text-3xl font-bold text-gray-800">Add New Student</h1>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Personal Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">Personal Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" name="first_name" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" name="last_name" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                    <input type="text" name="phone"
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                    <input type="date" name="date_of_birth" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                                    <select name="gender" required
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-400 transition-colors">
                                        <input type="file" name="photo" accept="image/*" id="photo-input"
                                               class="hidden" onchange="previewPhoto(event)">
                                        <label for="photo-input" class="cursor-pointer">
                                            <div id="photo-preview" class="mb-3">
                                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                                <p class="text-gray-500 mt-2">Click to upload photo</p>
                                                <p class="text-xs text-gray-400">PNG, JPG, GIF up to 2MB</p>
                                            </div>
                                        </label>
                                    </div>
                                    @error('photo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Admission Date</label>
                                    <input type="date" name="admission_date" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('admission_date', date('Y-m-d')) }}">
                                    @error('admission_date')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">Address Information</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                    <textarea name="address" required rows="3"
                                              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                    <input type="text" name="city" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('city') }}">
                                    @error('city')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                                    <select name="state" required
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select State</option>
                                        <option value="Alabama" {{ old('state') == 'Alabama' ? 'selected' : '' }}>Alabama</option>
                                        <option value="Alaska" {{ old('state') == 'Alaska' ? 'selected' : '' }}>Alaska</option>
                                        <option value="Arizona" {{ old('state') == 'Arizona' ? 'selected' : '' }}>Arizona</option>
                                        <option value="Arkansas" {{ old('state') == 'Arkansas' ? 'selected' : '' }}>Arkansas</option>
                                        <option value="California" {{ old('state') == 'California' ? 'selected' : '' }}>California</option>
                                        <option value="Colorado" {{ old('state') == 'Colorado' ? 'selected' : '' }}>Colorado</option>
                                        <option value="Connecticut" {{ old('state') == 'Connecticut' ? 'selected' : '' }}>Connecticut</option>
                                        <option value="Delaware" {{ old('state') == 'Delaware' ? 'selected' : '' }}>Delaware</option>
                                        <option value="Florida" {{ old('state') == 'Florida' ? 'selected' : '' }}>Florida</option>
                                        <option value="Georgia" {{ old('state') == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                                        <option value="Hawaii" {{ old('state') == 'Hawaii' ? 'selected' : '' }}>Hawaii</option>
                                        <option value="Idaho" {{ old('state') == 'Idaho' ? 'selected' : '' }}>Idaho</option>
                                        <option value="Illinois" {{ old('state') == 'Illinois' ? 'selected' : '' }}>Illinois</option>
                                        <option value="Indiana" {{ old('state') == 'Indiana' ? 'selected' : '' }}>Indiana</option>
                                        <option value="Iowa" {{ old('state') == 'Iowa' ? 'selected' : '' }}>Iowa</option>
                                        <option value="Kansas" {{ old('state') == 'Kansas' ? 'selected' : '' }}>Kansas</option>
                                        <option value="Kentucky" {{ old('state') == 'Kentucky' ? 'selected' : '' }}>Kentucky</option>
                                        <option value="Louisiana" {{ old('state') == 'Louisiana' ? 'selected' : '' }}>Louisiana</option>
                                        <option value="Maine" {{ old('state') == 'Maine' ? 'selected' : '' }}>Maine</option>
                                        <option value="Maryland" {{ old('state') == 'Maryland' ? 'selected' : '' }}>Maryland</option>
                                        <option value="Massachusetts" {{ old('state') == 'Massachusetts' ? 'selected' : '' }}>Massachusetts</option>
                                        <option value="Michigan" {{ old('state') == 'Michigan' ? 'selected' : '' }}>Michigan</option>
                                        <option value="Minnesota" {{ old('state') == 'Minnesota' ? 'selected' : '' }}>Minnesota</option>
                                        <option value="Mississippi" {{ old('state') == 'Mississippi' ? 'selected' : '' }}>Mississippi</option>
                                        <option value="Missouri" {{ old('state') == 'Missouri' ? 'selected' : '' }}>Missouri</option>
                                        <option value="Montana" {{ old('state') == 'Montana' ? 'selected' : '' }}>Montana</option>
                                        <option value="Nebraska" {{ old('state') == 'Nebraska' ? 'selected' : '' }}>Nebraska</option>
                                        <option value="Nevada" {{ old('state') == 'Nevada' ? 'selected' : '' }}>Nevada</option>
                                        <option value="New Hampshire" {{ old('state') == 'New Hampshire' ? 'selected' : '' }}>New Hampshire</option>
                                        <option value="New Jersey" {{ old('state') == 'New Jersey' ? 'selected' : '' }}>New Jersey</option>
                                        <option value="New Mexico" {{ old('state') == 'New Mexico' ? 'selected' : '' }}>New Mexico</option>
                                        <option value="New York" {{ old('state') == 'New York' ? 'selected' : '' }}>New York</option>
                                        <option value="North Carolina" {{ old('state') == 'North Carolina' ? 'selected' : '' }}>North Carolina</option>
                                        <option value="North Dakota" {{ old('state') == 'North Dakota' ? 'selected' : '' }}>North Dakota</option>
                                        <option value="Ohio" {{ old('state') == 'Ohio' ? 'selected' : '' }}>Ohio</option>
                                        <option value="Oklahoma" {{ old('state') == 'Oklahoma' ? 'selected' : '' }}>Oklahoma</option>
                                        <option value="Oregon" {{ old('state') == 'Oregon' ? 'selected' : '' }}>Oregon</option>
                                        <option value="Pennsylvania" {{ old('state') == 'Pennsylvania' ? 'selected' : '' }}>Pennsylvania</option>
                                        <option value="Rhode Island" {{ old('state') == 'Rhode Island' ? 'selected' : '' }}>Rhode Island</option>
                                        <option value="South Carolina" {{ old('state') == 'South Carolina' ? 'selected' : '' }}>South Carolina</option>
                                        <option value="South Dakota" {{ old('state') == 'South Dakota' ? 'selected' : '' }}>South Dakota</option>
                                        <option value="Tennessee" {{ old('state') == 'Tennessee' ? 'selected' : '' }}>Tennessee</option>
                                        <option value="Texas" {{ old('state') == 'Texas' ? 'selected' : '' }}>Texas</option>
                                        <option value="Utah" {{ old('state') == 'Utah' ? 'selected' : '' }}>Utah</option>
                                        <option value="Vermont" {{ old('state') == 'Vermont' ? 'selected' : '' }}>Vermont</option>
                                        <option value="Virginia" {{ old('state') == 'Virginia' ? 'selected' : '' }}>Virginia</option>
                                        <option value="Washington" {{ old('state') == 'Washington' ? 'selected' : '' }}>Washington</option>
                                        <option value="West Virginia" {{ old('state') == 'West Virginia' ? 'selected' : '' }}>West Virginia</option>
                                        <option value="Wisconsin" {{ old('state') == 'Wisconsin' ? 'selected' : '' }}>Wisconsin</option>
                                        <option value="Wyoming" {{ old('state') == 'Wyoming' ? 'selected' : '' }}>Wyoming</option>
                                    </select>
                                    @error('state')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Zip Code</label>
                                    <input type="text" name="zip_code" required
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('zip_code') }}">
                                    @error('zip_code')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                    <select name="country" required
                                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Select Country</option>
                                        <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                        <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                        <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                                        <option value="Italy" {{ old('country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                        <option value="Spain" {{ old('country') == 'Spain' ? 'selected' : '' }}>Spain</option>
                                        <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                        <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                                        <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="Brazil" {{ old('country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                        <option value="Mexico" {{ old('country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                        <option value="Argentina" {{ old('country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                        <option value="Chile" {{ old('country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                        <option value="Colombia" {{ old('country') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                        <option value="Peru" {{ old('country') == 'Peru' ? 'selected' : '' }}>Peru</option>
                                        <option value="Venezuela" {{ old('country') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                        <option value="South Africa" {{ old('country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                        <option value="Egypt" {{ old('country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                        <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Kenya" {{ old('country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                        <option value="Morocco" {{ old('country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                        <option value="Ghana" {{ old('country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                        <option value="Russia" {{ old('country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                                        <option value="Poland" {{ old('country') == 'Poland' ? 'selected' : '' }}>Poland</option>
                                        <option value="Netherlands" {{ old('country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                        <option value="Belgium" {{ old('country') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                        <option value="Switzerland" {{ old('country') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                        <option value="Austria" {{ old('country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                        <option value="Sweden" {{ old('country') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                        <option value="Norway" {{ old('country') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                        <option value="Denmark" {{ old('country') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                        <option value="Finland" {{ old('country') == 'Finland' ? 'selected' : '' }}>Finland</option>
                                        <option value="Ireland" {{ old('country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                        <option value="Portugal" {{ old('country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                        <option value="Greece" {{ old('country') == 'Greece' ? 'selected' : '' }}>Greece</option>
                                        <option value="Turkey" {{ old('country') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                        <option value="Israel" {{ old('country') == 'Israel' ? 'selected' : '' }}>Israel</option>
                                        <option value="Saudi Arabia" {{ old('country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                        <option value="UAE" {{ old('country') == 'UAE' ? 'selected' : '' }}>UAE</option>
                                        <option value="Singapore" {{ old('country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                        <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                        <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                        <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                        <option value="Philippines" {{ old('country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                        <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                        <option value="South Korea" {{ old('country') == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                                        <option value="New Zealand" {{ old('country') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                    </select>
                                    @error('country')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Parent Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4 text-gray-800">Parent Information (Optional)</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Parent Name</label>
                                    <input type="text" name="parent_name"
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('parent_name') }}">
                                    @error('parent_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Parent Phone</label>
                                    <input type="text" name="parent_phone"
                                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           value="{{ old('parent_phone') }}">
                                    @error('parent_phone')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('students.index') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-save mr-2"></i> Save Student
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        function previewPhoto(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('photo-preview');
            
            if (file) {
                // Check file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Photo size must be less than 2MB');
                    event.target.value = '';
                    return;
                }
                
                // Check file type
                if (!file.type.match('image.*')) {
                    alert('Please select an image file');
                    event.target.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Photo preview" class="w-32 h-32 object-cover rounded-full mx-auto mb-2">
                        <p class="text-green-600 text-sm">Photo selected</p>
                        <p class="text-xs text-gray-400">${file.name}</p>
                    `;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
