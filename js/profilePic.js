$(document).ready(function () 
{
    // Close the dropdown if the user clicks outside of it
    $(document).on("click", function(event)
     {
        if (!$(event.target).closest('#profilePic').length) 
        {
            var dropdown = $("#dropdownContent");
            if (dropdown.is(":visible")) 
            {
                dropdown.slideUp();
            }
        }
    });

    // Attach the function to the window resize event
    $(window).resize(function () 
    {
        checkWindowSize();
    });
});

function toggleDropdown() 
{
    var dropdown = $("#dropdownContent");
    dropdown.slideToggle();
}

function toggleMenu() 
{
    var navList = $('nav ul');
    navList.slideToggle().toggleClass('show');
}

// Function to check window width
function checkWindowSize() 
{
    // Get the width of the window
    var windowWidth = $(window).width();
    var navList = $('nav ul');

    var changed = false;

    // Check if the window width is below a certain size
    if (windowWidth < 984) 
    {
        if (!changed) navList.hide();
        changed = false;
        navList.removeClass('show');
        console.log('Window is smaller than 984 pixels');
    } 
    else if (!changed) 
    {
        changed = true;
        navList.show();
        console.log('Window is 984 pixels or larger');
    }
}