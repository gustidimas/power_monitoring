# Simple PHP and MySQL Authentication

This is a basic web application built using PHP and MySQL that demonstrates user authentication (login and registration) with session management. 
The key future of this application is that it ensures remain logged in until they explicity log out, and prevents logged-in users from accessing the login or registration pages.

## How it Works
1. Session-Based Authentication:
   - When a user logs in successfully, a session in created to store their login status.
   - The session persists across page, ensuring the user remains authenticated until they log out or close the browser.
2. Preventing Access to Login/Register Pages:
   - If a user is already logged in, they are redirected away from the login and registration pages to prevent redundant actions.
3. Logout Mechanism:
   - When the user clicks "Logout", the session is destroyed, effectively ending their session and requiring them to log in again.
  
## Key Features
- Persistent Login: Users stay logged in until they explicity log out.
- Restricted Access: Logged-in users cannot access the login or registration pages.
- Secure Authentication: Passwords are hashed before being stored in the database for security.

## Conclusion
This simple PHP and MySQL website demonstrates how to use sessions to manage user authentication effectively. By preventing logged-in users from accessing 
the login and registration pages and ensuring they remain logged in until they log out, the application provides a seamless and secure user experience. This
structure can serve as a foundation for more complex web applications with addintional features like data monitoring, role-based access control, and more.
