/**
* This source file is available under the terms of the
* Pimcore Open Core License (POCL)
* Full copyright and license information is available in
* LICENSE.md which is distributed with this source code.
*
*  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.com)
*  @license    Pimcore Open Core License (POCL)
*/

pimcore.registerNS("pimcore.object.tags.targetGroupMultiselect");
/**
 * @private
 */
pimcore.object.tags.targetGroupMultiselect = Class.create(pimcore.object.tags.multiselect, {

    type: "targetGroupMultiselect",

    getGridColumnFilter: function (field) {
        return null;
    }
});
