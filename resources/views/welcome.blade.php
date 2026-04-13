<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Profile Generator</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffe0eb;
            color: #333;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h1, h2, h3 { color: #d63384; text-align: center; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="number"], textarea {
            width: 100%; padding: 12px 15px; border: 2px solid #ffb6c1;
            border-radius: 8px; box-sizing: border-box; font-size: 16px;
            background-color: #fffaf0;
        }
        input:focus, textarea:focus { border-color: #d63384; outline: none; }
        .radio-group { display: flex; gap: 20px; padding: 10px 0; }
        .checkbox-group { display: flex; gap: 15px; flex-wrap: wrap; padding: 10px 0; }
        .checkbox-item, .radio-item { display: flex; align-items: center; font-weight: normal; }
        input[type="checkbox"], input[type="radio"] { margin-right: 8px; accent-color: #d63384; transform: scale(1.2); }
        .profile-list { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 30px; }
        .profile-card { background-color: #fffaf0; border: 2px solid #ffb6c1; padding: 20px; border-radius: 12px; }
        .hobby-tag { display: inline-block; background-color: #ffb6c1; color: #fff; padding: 5px 12px; border-radius: 20px; font-size: 0.85em; margin: 3px; }
        .btn { padding: 12px 30px; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; border: none; transition: 0.2s; }
        .btn-submit { background-color: #d63384; color: white; width: 100%; margin-top: 10px; }
        .btn-submit:hover { background-color: #b02167; }
        .btn-clear { background-color: white; color: #d63384; border: 2px solid #ffb6c1; width: 100%; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Personal Profile Generator</h1>

    <form action="/profiles" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
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
                <label class="radio-item"><input type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required> Male</label>
                <label class="radio-item"><input type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required> Female</label>
            </div>
        </div>

        <div class="form-group">
            <label>Hobbies (Select at least 5)</label>
            <div class="checkbox-group">
                @php
                    $hobbies = ['Coding', 'Reading', 'Gaming', 'Hiking', 'Cooking', 'Music', 'Photography', 'Traveling', 'Dancing', 'Sports'];
                @endphp
                @foreach ($hobbies as $hobby)
                    <div class="checkbox-item">
                        <input type="checkbox" id="hobby_{{ $loop->index }}" name="hobbies[]" value="{{ $hobby }}"
                            @if(is_array(old('hobbies')) && in_array($hobby, old('hobbies'))) checked @endif>
                        <label for="hobby_{{ $loop->index }}">{{ $hobby }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label>Short Bio</label>
            <textarea name="bio" rows="3" required>{{ old('bio') }}</textarea>
        </div>

        <button type="submit" class="btn btn-submit">Add Profile</button>
    </form>

    <hr style="border: 0; border-top: 1px solid #ffb6c1; margin: 40px 0;">

    <form action="/profiles/clear" method="POST">
        @csrf
        <button type="submit" class="btn btn-clear">Clear All Profiles</button>
    </form>

    <h2>Saved Profiles</h2>
    <div class="profile-list">
        @forelse($profiles as $profile)
            <div class="profile-card">
                <h3>{{ $profile['name'] }}</h3>
                <p><strong>Age:</strong> {{ $profile['age'] }}</p>
                <p><strong>Program:</strong> {{ $profile['program'] }}</p>
                <p><strong>Email:</strong> {{ $profile['email'] }}</p>
                <p><strong>Bio:</strong> {{ $profile['bio'] }}</p>
                <div>
                    <strong>Hobbies:</strong><br>
                    @foreach($profile['hobbies'] as $h)
                        <span class="hobby-tag">{{ $h }}</span>
                    @endforeach
                </div>
            </div>
        @empty
            <p style="text-align: center; grid-column: 1/-1;">No profiles yet.</p>
        @endforelse
    </div>
</div>

</body>
</html>