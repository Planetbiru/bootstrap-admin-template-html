<?php

class TemplateDrowpdownMenu
{
    const NEW_LINE_TAB1 = "\n\t";
    const NEW_LINE_TAB2 = "\n\t\t";
    const NEW_LINE_TAB3 = "\n\t\t\t";

    /**
     * Creates a badge with the given count.
     *
     * This method generates a badge string that displays a count. 
     * If the count exceeds 99, it returns "99+".
     * If the count is between 1 and 99, it returns the count as a string.
     * If the count is 0 or negative, it returns an empty string.
     *
     * @param int $count The count to display in the badge.
     * @return string The badge string, either the count, "99+", or an empty string.
     */
    public function createBadge($count)
    {
        // If count exceeds 99, return '99+'
        if ($count > 99) {
            return "99+";
        } else if ($count > 0 && $count <= 99) {
            return "$count"; // Return the count as a string for counts between 1 and 99
        } else {
            return ""; // Return an empty string if count is 0 or negative
        }
    }

    /**
     * Initializes and generates the HTML for a notification dropdown menu.
     *
     * This method creates the HTML structure for a notification dropdown menu, 
     * including the notification toggle button, the notification items, 
     * and the badge indicating the number of notifications. 
     * It loops through the provided notifications data and creates individual 
     * notification elements with messages and timestamps.
     * 
     * @param array $notifications An array containing notification data.
     *      - 'data': An array of notification objects containing 'message', 'time', 'link', and 'id'.
     *      - 'totalData': The total number of notifications to display in the badge.
     * @param string $id1 The ID for the <a> tag of the notification toggle button.
     * @param string $id2 The ID for the <div> tag of the notification dropdown menu.
     * @param string $icon The CSS class for the icon to be displayed in the toggle button (e.g., 'fas fa-bell').
     * 
     * @return string The HTML structure for the notification dropdown menu.
     */
    public function dropdownMenu($notifications, $id1, $id2, $icon) {
        // Create DOMDocument object to handle HTML structure
        $dom = new DOMDocument();
        $dom->formatOutput = true;

        // Create the <li> element for the notification dropdown
        $notificationItem = $dom->createElement('li');
        $notificationItem->setAttribute('class', 'nav-item dropdown');
        $notificationItem->setAttribute('data-badge', $this->createBadge($notifications['totalData'])); // Set data-badge attribute

        // Create the <a> tag for the notification toggle
        $a = $dom->createElement('a');
        $a->setAttribute('class', 'nav-link dropdown-toggle');
        $a->setAttribute('href', '#');
        $a->setAttribute('id', $id1);
        $a->setAttribute('role', 'button');
        $a->setAttribute('data-toggle', 'dropdown');

        // Create the <i> element for the bell icon
        $i = $dom->createElement('i', '');
        $i->setAttribute('class', $icon);
        $a->appendChild($i); // Append the <i> tag to the <a> tag
        
        $space4 = $dom->createTextNode(self::NEW_LINE_TAB2);
        $notificationItem->appendChild($space4);

        $notificationItem->appendChild($a);

        // Create the <div> for the dropdown menu
        $dropdownMenu = $dom->createElement('div');
        $dropdownMenu->setAttribute('class', 'dropdown-menu dropdown-menu-right');
        $dropdownMenu->setAttribute('aria-labelledby', $id1);
        $dropdownMenu->setAttribute('id', $id2);
        $notificationItem->appendChild($dropdownMenu);
        
        $space1 = $dom->createTextNode(self::NEW_LINE_TAB2);
        $notificationItem->appendChild($space1);
        $notificationItem->appendChild($dropdownMenu);

        if(isset($notifications['data']) && is_array($notifications['data']))
        {
            // Loop through the notifications and create <a> elements
            foreach ($notifications['data'] as $notification) {
                // Create the <a> element for the notification
                $aNotification = $dom->createElement('a');
                $aNotification->setAttribute("timestamp", $notification["timestamp"]);
                $aNotification->setAttribute('class', 'dropdown-item');
                $aNotification->setAttribute('href', htmlspecialchars($notification['link']));
                $aNotification->setAttribute('data-id', htmlspecialchars($notification['id']));

                // Create the text node for the notification message
                $messageText = $dom->createTextNode(htmlspecialchars($notification['message']));
                $aNotification->appendChild($messageText); // Append the message text to the <a> tag

                // Create the <small> element for the time
                $smallTag = $dom->createElement('small', htmlspecialchars($notification['time']));
                $smallTag->setAttribute('class', 'text-muted'); // Set class for small tag
                
                $space2 = $dom->createTextNode(self::NEW_LINE_TAB3);
                $dropdownMenu->appendChild($space2);
                
                $notificationItem->appendChild($dropdownMenu);
                
                $aNotification->appendChild($smallTag); // Append the <small> tag to the <a> tag

                // Append the <a> element to the dropdown menu
                $dropdownMenu->appendChild($aNotification);

            }
        }
        $space3 = $dom->createTextNode(self::NEW_LINE_TAB2);
        $dropdownMenu->appendChild($space3);
        
        $space5 = $dom->createTextNode(self::NEW_LINE_TAB1);
        $notificationItem->appendChild($space5);
        
        // Return the HTML for the notification dropdown
        return "\t".$dom->saveHTML($notificationItem)."\n";
    }

}
