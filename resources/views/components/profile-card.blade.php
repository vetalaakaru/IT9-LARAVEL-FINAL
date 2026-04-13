@props(['profile'])

<div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; border-radius: 8px;">
    <h3>{{ $profile['name'] }} ({{ $profile['age'] }})</h3>
    <p><strong>Program:</strong> {{ $profile['program'] }}</p>
    <p><strong>Email:</strong> {{ $profile['email'] }}</p>
    <p><strong>Gender:</strong> {{ ucfirst($profile['gender']) }}</p>
    <p><strong>Hobbies:</strong> {{ implode(', ', $profile['hobbies']) }}</p>
    <p><strong>Bio:</strong> {{ $profile['bio'] }}</p>
</div>