# Simple Reading Time Plugin ⏱️

A lightweight and clean WordPress plugin that automatically calculates and displays the estimated reading time at the top of single posts.

🚀 Features
- **Automatic Calculation:** Based on an average reading speed of 200 words per minute.
- **Lightweight:** No external CSS or JS files loaded (inline styles for performance).
- **Secure:** Built with WordPress coding standards and security practices.
- **Developer Friendly:** Object-Oriented structure.

🛠 Installation
1. Download the plugin zip file.
2. Go to your WordPress Dashboard > Plugins > Add New.
3. Click "Upload Plugin" and activate.
4. Visit any single blog post to see the result!

💻 Code Structure
This plugin demonstrates:
- Usage of WordPress Filters (`the_content`).
- Basic PHP Math functions (`ceil`, `str_word_count`).
- Security checks (`ABSPATH`, `esc_html__`).
- Object-Oriented Programming (OOP) in WordPress.

Usage
You can use this plugin in two ways:
1. Automatic Mode: The reading time is automatically added to the top of every single post.
2. Shortcode Mode: Use the shortcode `[reading_time]` anywhere in your posts, pages, or widgets.
   Example: Great for placing inside **Elementor** or Custom Layouts.

👨‍💻 Author
Developed by NockStudio 
