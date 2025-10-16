<form method="POST" action="{{ url('/first-login/' . $encryptedId) }}">
    @csrf
    <label>New Password:</label>
    <input type="password" name="password" >

    <label>Confirm Password:</label>
    <input type="password" name="password_confirmation" >

    <button type="submit">Set Password</button>
</form>
