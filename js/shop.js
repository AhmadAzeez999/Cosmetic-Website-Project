var buttonElements = document.getElementsByClassName('addedToCart');

var i = 0;
while (i < buttonElements.length)
{
    var currentElement = buttonElements[i];
    currentElement.disabled = true;
    i++;
}