# Dashboard UI Fix & Ogani Theme TODO

## Step 1: Fix header.php
- [x] Add missing `</body></html>` closing tags
- [x] Add sidebar toggle JavaScript
- [x] Add fullscreen toggle JavaScript
- [x] Add Ctrl+K keyboard shortcut for search

## Step 2: Fix index.php
- [x] Already clean - no broken HTML, no beacon.min.js, proper closing structure

## Step 3: Fix categoryform.php
- [x] Convert to admin layout (admin-main, container-fluid)
- [x] Use Ogani green theme instead of indigo (#6366f1)
- [x] Remove inline styles, use CSS classes (ogani-card-header, btn-ogani)

## Step 4: Fix productform.php
- [x] Convert to admin layout (admin-main, container-fluid)
- [x] Use Ogani green theme instead of indigo (#6366f1)
- [x] Remove inline styles, use CSS classes (ogani-card-header, btn-ogani)

## Step 5: Update custom.css
- [x] Add `.product-image` class
- [x] Add `.stock-badge` classes
- [x] Add form page card header class (ogani-card-header)
- [x] Add sidebar toggle button styles (hamburger-menu)
- [x] Add `.btn-ogani` button class
- [x] Add search container styles
- [x] Ensure Ogani green (#7fad39) is primary color throughout

## Step 6: Polish remaining pages
- [x] Fix users.php - removed duplicate `</div>` closing tag
- [x] Fix orders.php - added orderTable Alpine component, removed beacon.min.js
- [x] Fix products.php - added productTable and productForm Alpine components, removed beacon.min.js
- [x] Verify Ogani theme consistency across all pages
- [ ] Test all pages load without console errors
