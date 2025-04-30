/**
* This source file is available under the terms of the
* Pimcore Open Core License (POCL)
* Full copyright and license information is available in
* LICENSE.md which is distributed with this source code.
*
*  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.com)
*  @license    Pimcore Open Core License (POCL)
*/

pimcore.registerNS("pimcore.bundle.personalization.settings.action.abstract");
/**
 * @private
 */
pimcore.bundle.personalization.settings.action.abstract = Class.create({
    getName: function () {
        console.error('Name is not set for action', this);
    },

    getIconCls: function () {
        return 'pimcore_icon_add';
    },

    getPanel: function () {
        console.error('You have to implement the getPanel() method in action', this);
    }
});
