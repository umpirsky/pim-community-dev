'use strict';

define(
    ['jquery', 'underscore', 'routing', 'pim/entity-manager', 'pim/attribute-manager'],
    function ($, _, Routing, EntityManager, AttributeManager) {
    return {
        getAttributeGroupsForProduct: function (product) {
            var deferred = $.Deferred();

            $.when(
                EntityManager.getRepository('attributeGroup').findAll(),
                AttributeManager.getAttributesForProduct(product)
            ).done(_.bind(function (attributeGroups, productAttributes) {
                var activeAttributeGroups = {};
                _.each(attributeGroups, function (attributeGroup) {
                    if (_.intersection(attributeGroup.attributes, productAttributes).length > 0) {
                        activeAttributeGroups[attributeGroup.code] = attributeGroup;
                    }
                });

                deferred.resolve(activeAttributeGroups);
            }, this));

            return deferred.promise();
        },
        getAttributeGroupValues: function (values, attributeGroup) {
            var matchingValues = {};
            if (!attributeGroup) {
                return matchingValues;
            }
            _.each(attributeGroup.attributes, function (attributeCode) {
                if (values[attributeCode]) {
                    matchingValues[attributeCode] = values[attributeCode];
                }
            });

            return matchingValues;
        },
        getAttributeGroupForAttribute: function (attributeGroups, attribute) {
            var result = null;

            _.each(attributeGroups, function (attributeGroup) {
                if (-1 !== attributeGroup.attributes.indexOf(attribute)) {
                    result = attributeGroup.code;
                }
            });

            return result;
        }
    };
});