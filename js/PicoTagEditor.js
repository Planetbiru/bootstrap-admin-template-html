/**
 * PicoTagEditor constructor function.
 * Initializes the tag editor, transforming an input element into an interactive tag manager.
 * Users can add, edit, and remove tags dynamically.
 *
 * @param {HTMLElement} input - The input element to be transformed into a tag editor.
 * @param {Object} [options={}] - Optional configuration settings.
 * @param {boolean} [options.debug=false] - Enables or disables debugging features.
 * @param {string|number} [options.width] - The width of the tag editor container.
 * @param {string|number} [options.height] - The height of the tag editor container.
 * @param {string|number} [options.maxHeight] - The maximum height of the tag editor container.
 * @param {boolean} [options.trimInput=false] - Flag to trim input.
 * @param {Function} [callback] - A function to execute after initialization.
 */
function PicoTagEditor(input, options, callback) {
    options = options || {};
    /**
     * Configuration settings for the tag editor.
     * @type {Object}
     * @property {boolean} debug - Debug mode status.
     * @property {string|number} width - Width of the tag editor.
     * @property {string|number} height - Height of the tag editor.
     * @property {string|number} maxHeight - Maximum height of the tag editor.
     */
    this.settings = {
        debug: false,
        width: undefined,
        height: undefined,
        minWidth: undefined,
        maxHeight: undefined,
        trimInput: false,
        ...options // Merge user-defined options
    };

    /**
     * Main container element for the tag editor.
     * @type {HTMLElement|null}
     */
    this.containerElement = null;

    /**
     * Name attribute for hidden input fields storing tag values.
     * @type {string}
     */
    this.name = '';

    /**
     * Tracks mouse hover status over the tag editor container.
     * @type {boolean}
     */
    this.mouseEnter = false;

    /**
     * Input field for entering new tags.
     * @type {HTMLElement|null}
     */
    this.inputElement = null;

    /**
     * Stores a reference to a timeout ID, used for delaying certain actions.
     * This can be used to clear or reset timeouts when needed.
     * 
     * @type {number|null}
     */
    this.timeout = null;

    /**
     * Holds an array of tag values extracted from hidden input fields.
     * This is dynamically updated whenever tag values change.
     * 
     * @type {Array<string>}
     */
    this.values = [];

    /**
     * Stores the default placeholder text for the input field.
     * This is updated dynamically based on the presence of tag values.
     * 
     * @type {string}
     */
    this.placeholder = '';


    /**
     * Initializes the tag editor, transforming the original input field into an interactive tag manager.
     *
     * @param {HTMLElement} input - The input element to transform.
     */
    this.init = function (input) {
        // Create the tag editor container
        const tagEditorDiv = document.createElement('div');
        tagEditorDiv.classList.add('pico-tag-editor');

        // Clone the original input field
        const newInput = input.cloneNode(true);

        // Create a container for tags
        const tagsContainer = document.createElement('div');
        tagsContainer.classList.add('tags-container');
        tagsContainer.style.display = 'none'; // Initially hidden

        // Apply custom styles if defined in settings
        const styles = ['width', 'height', 'maxHeight', 'minWidth'];
        styles.forEach(prop => {
            if (this.settings[prop]) {
                tagsContainer.style[prop] = this.isNumber(this.settings[prop]) ? `${this.settings[prop]}px` : this.settings[prop];
            }
        });

        // Append elements to the tag editor container
        tagEditorDiv.appendChild(newInput);
        tagEditorDiv.appendChild(tagsContainer);

        // Replace the original input with the new tag editor
        input.replaceWith(tagEditorDiv);
        this.containerElement = tagEditorDiv;
        this.inputElement = newInput;
        this.name = newInput.getAttribute('name') || '';
        // Ensure the name format supports array-like inputs
        if (!this.name.includes('[')) {
            this.name += '[]';
        }
        if(!newInput.classList.contains('pico-tag-edit'))
        {
            // Ensure that the input element has the pico-tag-edit class.
            newInput.classList.add('pico-tag-edit');
        }
        this.placeholder = newInput.getAttribute('placeholder') || '';
        
    };

    /**
     * Checks if a given value is a number.
     *
     * @param {string|number} value - The value to check.
     * @returns {boolean} True if the value is a valid number, otherwise false.
     */
    this.isNumber = function (value) {
        return /^-?\d+(\.\d+)?$/.test(value);
    };

    /**
     * Attaches event listeners for handling tag input and interaction.
     */
    this.addEvents = function () {
        const inputField = this.containerElement.querySelector('.pico-tag-edit');
        if (!inputField) return;
    
        // Handle "Enter" keypress to add a new tag
        inputField.addEventListener('keypress', event => {
            if (event.key === 'Enter' && event.target.value.trim()) {
                _this.addTag(_this.settings.trimInput ? event.target.value.trim() : event.target.value);
                event.target.value = ''; // Clear input field after adding tag
                event.preventDefault();
            }
        });
    
        // Handle focus state changes
        inputField.addEventListener('focus', () => _this.containerElement.setAttribute('data-focus', 'true'));
        inputField.addEventListener('blur', () => {
            _this.containerElement.setAttribute('data-focus', _this.settings.debug || _this.mouseEnter ? 'true' : 'false');
        });
    
        // Track mouse enter and leave events for focus handling
        ['mouseenter', 'mouseleave'].forEach(eventType => {
            this.containerElement.addEventListener(eventType, () => {
                _this.mouseEnter = eventType === 'mouseenter';
                if (_this.timeout) clearTimeout(_this.timeout);
                if (!_this.mouseEnter) {
                    _this.timeout = setTimeout(() => _this.containerElement.setAttribute('data-focus', 'false'), 1500);
                }
            });
        });
    };
    

    /**
     * Adds a new tag to the tag editor.
     *
     * @param {string} tagText - The text content of the new tag.
     */
    this.addTag = function (tagText) {
        const tagContainer = this.containerElement.querySelector('.tags-container');

        // Create a new tag element
        const tag = document.createElement('div');
        tag.classList.add('pico-tag');
        tag.textContent = tagText;

        // Create hidden input field to store the tag value
        const inputHidden = document.createElement('input');
        inputHidden.type = 'hidden';
        inputHidden.name = this.name;
        inputHidden.value = tagText;
        tag.appendChild(inputHidden);

        // Create a remove button for the tag
        const removeSpan = document.createElement('span');
        removeSpan.innerHTML = '&times;'; // "×" symbol for removing tags
        removeSpan.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            tagContainer.removeChild(tag); // Remove tag on click
            _this.containerElement.querySelector('.pico-tag-edit').focus(); // Refocus input
            _this.updateValues();
            // Hide container if no tags remain
            if (!tagContainer.querySelector('.pico-tag')) {
                tagContainer.style.display = 'none';
            }
        });

        tag.appendChild(removeSpan);
        tagContainer.appendChild(tag);
        tagContainer.style.display = ''; // Ensure the tag container is visible
        this.updateValues();
    };

    /**
     * Updates the stored values from hidden input fields inside `.pico-tag` elements.
     * This function collects all tag values, updates the internal `values` array, 
     * and adjusts the placeholder of the `.pico-tag-edit` input accordingly.
     */
    this.updateValues = function() {
        this.values = [];
        
        // Select all hidden input fields inside `.pico-tag` elements
        let tags = this.containerElement.querySelectorAll('.pico-tag input[type="hidden"]');

        if (typeof tags !== 'undefined') {
            for (let tag of tags) {
                this.values.push(tag.value);
            }
        }

        // Update the placeholder of the `.pico-tag-edit` input
        let inputElement = this.containerElement.querySelector('.pico-tag-edit');
        inputElement.setAttribute('placeholder', this.values.length > 0 ? `[${this.values.join(', ')}]` : this.placeholder);
    };


    // Store reference to the current instance
    let _this = this;

    // Initialize the editor, apply user settings, and bind events
    this.init(input);
    if (callback) {
        callback(this.inputElement, this.containerElement, this);
    }
    this.addEvents();
}
