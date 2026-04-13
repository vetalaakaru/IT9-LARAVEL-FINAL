<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Profile Generator</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #ffe0eb; color: #333; max-width: 900px; margin: 40px auto; padding: 20px; }
        .container { background-color: #fff; padding: 40px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h1, h2, h3 { color: #d63384; text-align: center; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="number"], textarea {
            width: 100%; padding: 12px 15px; border: 2px solid #ffb6c1; border-radius: 8px; box-sizing: border-box; background-color: #fffaf0;
        }
        .radio-group, .checkbox-group { display: flex; gap: 15px; flex-wrap: wrap; padding: 10px 0; }
        .profile-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 30px; }
        .profile-card { background-color: #fffaf0; border: 2px solid #ffb6c1; padding: 20px; border-radius: 12px; line-height: 1.6; }
        .btn { padding: 12px 30px; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; border: none; width: 100%; margin-top: 10px; }
        .btn-submit { background-color: #d63384; color: white; }
        .btn-clear { background-color: #ff4d4d; color: white; margin-top: 20px; }
        .alert-danger { background-color: #f8d7da; color: #842029; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c2c7; }
        ul.hobby-list { list-style: none; padding-left: 15px; margin: 5px 0; }
    </style>
</head>
<body>
<div class="container">
    <h1>Personal Profile Generator</h1>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/profiles" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" value="{{ old('age') }}" required>
            </div>
        </div>

        <div class="form-group">
            <label>Program</label>
            <input type="text" name="program" value="{{ old('program') }}" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }} required> Male</label>
                <label><input type="radio" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }} required> Female</label>
            </div>
        </div>

        <div class="form-group">
            <label>Hobbies (Select at least 1)</label>
            <div class="checkbox-group">
                @php $hobbies = ['Coding', 'Reading', 'Gaming', 'Hiking', 'Cooking', 'Music', 'Photography', 'Traveling', 'Dancing', 'Sports']; @endphp
                @foreach ($hobbies as $hobby)
                    <div>
                        <input type="checkbox" id="hobby_{{ $loop->index }}" name="hobbies[]" value="{{ $hobby }}"
                            @if(is_array(old('hobbies')) && in_array($hobby, old('hobbies'))) checked @endif>
                        <label for="hobby_{{ $loop->index }}" style="display:inline; font-weight: normal;">{{ $hobby }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label>Short Biography</label>
            <textarea name="bio" rows="3" required>{{ old('bio') }}</textarea>
        </div>

        <button type="submit" class="btn btn-submit">Submit</button>
    </form>

    <form action="/profiles/clear" method="POST">
        @csrf
        <button type="submit" class="btn btn-clear">Delete all</button>
    </form>

    <hr style="border: 0; border-top: 2px solid #ffb6c1; margin: 40px 0;">

    <h2>Generated Profiles</h2>
    <div class="profile-list">
        @forelse($profiles as $profile)
            <div class="profile-card">
                <p><strong>Name:</strong> {{ $profile['name'] }}</p>
                <p><strong>Age:</strong> {{ $profile['age'] }}</p>
                <p><strong>Program:</strong> {{ $profile['program'] }}</p>
                <p><strong>Email:</strong> {{ $profile['email'] }}</p>
                <p><strong>Gender:</strong> {{ $profile['gender'] }}</p>
                <p><strong>Hobbies:</strong></p>
                <ul class="hobby-list">
                    @foreach($profile['hobbies'] as $h)
                        <li>{{ $h }}</li>
                    @endforeach
                </ul>
                <p><strong>Short Biography:</strong> {{ $profile['bio'] }}</p>
            </div>
        @empty
            <p style="text-align: center; grid-column: 1/-1;">No profiles yet.</p>
        @endforelse
    </div>
</div>
</body>
</html>