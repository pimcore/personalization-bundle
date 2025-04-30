/**
* This source file is available under the terms of the
* Pimcore Open Core License (POCL)
* Full copyright and license information is available in
* LICENSE.md which is distributed with this source code.
*
*  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.com)
*  @license    Pimcore Open Core License (POCL)
*/

pimcore.registerNS("pimcore.object.tags.targetGroup");
/**
 * @private
 */
pimcore.object.tags.targetGroup = Class.create(pimcore.object.tags.select, {

    type: "targetGroup",

    initialize: function (data, fieldConfig) {
        this.data = data;
        this.fieldConfig = fieldConfig;
        this.fieldConfig.width = 300;
    },

    getGridColumnFilter: function (field) {
        return null;
    }
});
