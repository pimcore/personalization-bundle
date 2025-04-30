/**
* This source file is available under the terms of the
* Pimcore Open Core License (POCL)
* Full copyright and license information is available in
* LICENSE.md which is distributed with this source code.
*
*  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.com)
*  @license    Pimcore Open Core License (POCL)
*/

pimcore.registerNS("pimcore.bundle.personalization.settings.condition.abstract");
/**
 * @private
 */
pimcore.bundle.personalization.settings.condition.abstract = Class.create({
    matchesScope: function (scope) {
        return 'targeting_rule' === scope;
    },

    getName: function () {
        console.error('Name is not set for condition', this);
    },

    getIconCls: function () {
        return 'pimcore_icon_add';
    },

    getPanel: function () {
        console.error('You have to implement the getPanel() method in condition', this);
    },

    isAvailable: function () {
        return true;
    }
});
