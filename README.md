# Framed Store

This a website for the final project of my capstone web programming course (INFSCI 1059) at the University of Pittsburgh. It is an online store that "sells" prints to decorate your apartment or house.

*NOTE: Although you can add items to your cart and checkout, there is no payment or actual ordering taking place so don't expect a print to show up at your door.*

---

### Project Features
This project is building off my project from last year that I made for CS 334 and INFSCI 1052 (http://njscholfield.x10host.com) to make it actually functional. If you're curious about what I changed from last year, [here you go](https://github.com/njscholfield/framed-website/compare/45b27551ca7f27d270c6410f2310dcb2ae0c1342...master)... Hopefully the functionality and UI is intuitive, but if not, here is what my project does and how it works.

#### Store
> click the *Store* link in the navbar

The store page shows all items available for sale. A user can filter by category or color (click the *Filter* link to expand the options) to find what they are looking for. If they are signed in, they can favorites items to look at later. Clicking on an item title takes them to the item page that gives more details, shows frame options, price, and an *Add to Cart* button if the user is logged in.

#### Account Registration
> click the *register* button in the navbar when not logged in

Users can register for an account which allows them to save favorite items, have a cart, and track order status. User passwords are hashed and salted to keep them secure in the database.

#### Account Settings
> when logged in, click your username in the navbar and select *Account Settings* from the dropdown

This is a page where a user can change their password and toggle whether their favorites pages is public or not. It also shows them the url they can use to share their favorites page with someone after it is made public.

#### Favoriting
> - click the heart icon in the navbar to view favorites when logged in
> - click the heart/favorite button on the store, favorites, or item page to favorite or unfavorite an item

Users can favorite items that they like and may want to purchase later. They can do this on the store page or favorites by clicking the heart button, or on the item page by clicking on the favorite there. They can also unfavorite from the same places by clicking the button again. User's can view their favorites by clicking the heart icon in the status bar when logged in. If they choose to, a user can make their favorites page public to share with others by going to their account settings page. When public it is accessible at `/favorites/?user=username` where `username` is the person's username.

#### Cart Functionality
Users can add items to their cart and then checkout to place an order. After placing an order, users can check the status of their orders from their order history page.
> - *you must be logged in to use the cart functionality*
> - click the *Add to Cart* button on an item page to add an item to the cart
> - click the cart icon in the navbar to see your Cart
> - click the *Checkout* button at the bottom of the cart page to checkout
> - click your username in the navbar and select *Order History* from the dropdown

#### Admin Panel
> When logged in with an Admin account, a link to the admin panel will show up in the profile dropdown in the navbar.

Once in the admin panel, there is a sidebar (or topbar on mobile) to navigate to the different pages to perform different actions. This panel allows users with Admin status to make changes to the store, and see all orders.

##### Dashboard (Speedometer icon in admin panel)
The dashboard shows an overview of pending orders, contact form submissions (from the about page), and the top 5 selling items in the store.

##### Orders (Shopping bag icon in admin panel)
Admin users can see and update the status of all orders. They can also filter (click the *Filter* link to expand options) the orders by their status (see only pending orders, etc.) and view them in ascending or descending order. Clicking on the *order number* opens up a modal with all the info for that item. It also lets you update the status of the order.

##### Items (Pencil icon in admin panel)
Admin users can also view, update, add, and delete items for sale in the store. Clicking the *pencil icon* next to each item opens a modal to update any of the item info. At the bottom of the update modal there is also a *delete button* to delete an item. To add a new item you click on the *green + button*, which opens a blank form to add a new item to the store.

#### Stuff I used
- PHP
- MySQL
- [Google Fonts](https://fonts.google.com)
  - [Open Sans](https://fonts.google.com/specimen/Open+Sans) (body font)
  - [Montserrat](https://fonts.google.com/specimen/Montserrat) (heading font)
- [Font Awesome](https://fontawesome.com)
- [Bootstrap](https://getbootstrap.com)
  - [Bootswatch Yeti Theme](https://bootswatch.com/yeti/)
- [Vue.js](https://vuejs.org/)
  - [BootstrapVue](https://bootstrap-vue.js.org/)
- [Axios.js](https://github.com/axios/axios)
- [ESLint](https://eslint.org/)
- [Unsplash](https://unsplash.com/)
  - [Album of images I used](https://unsplash.com/collections/1953059/framed)
- [Heroku](https://heroku.compress)
- [DevilBox](http://devilbox.org/) (for local development)
  - [Docker](https://www.docker.com/)
- [Atom](https://atom.io)
- [Hyper](https://hyper.is)
- [codeanywhere](https://codeanywhere.com/)
