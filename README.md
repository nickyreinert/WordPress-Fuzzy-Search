# Fuzzy Search
Fuzzy Search Shortcut for WordPress

This theme adds a shortcut that adds an input field to your post that allows you to fuzzy search all post titles and excerpts of a given category id. It returns a list of matching posts that you can click to browse to them.

This is for demonstration purposes only, that's why I didn't moved it to a plugin yet. You can simple use the logic as an plugin, if you need. 

The shortcut querys all existing posts and its excerpts at a time to reduce overhead. 

Add this shortcut to a post: 

[wp-faq-fuzzy-search search_category=5]

The integer represents the category id you want to search. 

If you add this shortcut to a post, you may want to add this post to a category called "fuzzy search page" - this way all other post elements will be removed. 

This project includes the great fuse-library, where all the magic comes from. I only implented it to run with WordPress :)

https://fusejs.io   