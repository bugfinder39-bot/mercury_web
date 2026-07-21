import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\PageController::index
 * @see app/Http/Controllers/Admin/PageController.php:26
 * @route '/admin/pages'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/pages',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PageController::index
 * @see app/Http/Controllers/Admin/PageController.php:26
 * @route '/admin/pages'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PageController::index
 * @see app/Http/Controllers/Admin/PageController.php:26
 * @route '/admin/pages'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\PageController::index
 * @see app/Http/Controllers/Admin/PageController.php:26
 * @route '/admin/pages'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\PageController::index
 * @see app/Http/Controllers/Admin/PageController.php:26
 * @route '/admin/pages'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\PageController::index
 * @see app/Http/Controllers/Admin/PageController.php:26
 * @route '/admin/pages'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\PageController::index
 * @see app/Http/Controllers/Admin/PageController.php:26
 * @route '/admin/pages'
 */
        indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index.form = indexForm
/**
* @see \App\Http\Controllers\Admin\PageController::edit
 * @see app/Http/Controllers/Admin/PageController.php:36
 * @route '/admin/pages/{page}/edit'
 */
export const edit = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/pages/{page}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\PageController::edit
 * @see app/Http/Controllers/Admin/PageController.php:36
 * @route '/admin/pages/{page}/edit'
 */
edit.url = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { page: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { page: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    page: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        page: typeof args.page === 'object'
                ? args.page.id
                : args.page,
                }

    return edit.definition.url
            .replace('{page}', parsedArgs.page.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PageController::edit
 * @see app/Http/Controllers/Admin/PageController.php:36
 * @route '/admin/pages/{page}/edit'
 */
edit.get = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\PageController::edit
 * @see app/Http/Controllers/Admin/PageController.php:36
 * @route '/admin/pages/{page}/edit'
 */
edit.head = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\PageController::edit
 * @see app/Http/Controllers/Admin/PageController.php:36
 * @route '/admin/pages/{page}/edit'
 */
    const editForm = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\PageController::edit
 * @see app/Http/Controllers/Admin/PageController.php:36
 * @route '/admin/pages/{page}/edit'
 */
        editForm.get = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\PageController::edit
 * @see app/Http/Controllers/Admin/PageController.php:36
 * @route '/admin/pages/{page}/edit'
 */
        editForm.head = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    edit.form = editForm
/**
* @see \App\Http\Controllers\Admin\PageController::update
 * @see app/Http/Controllers/Admin/PageController.php:60
 * @route '/admin/pages/{page}'
 */
export const update = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/pages/{page}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\PageController::update
 * @see app/Http/Controllers/Admin/PageController.php:60
 * @route '/admin/pages/{page}'
 */
update.url = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { page: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { page: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    page: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        page: typeof args.page === 'object'
                ? args.page.id
                : args.page,
                }

    return update.definition.url
            .replace('{page}', parsedArgs.page.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PageController::update
 * @see app/Http/Controllers/Admin/PageController.php:60
 * @route '/admin/pages/{page}'
 */
update.put = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\PageController::update
 * @see app/Http/Controllers/Admin/PageController.php:60
 * @route '/admin/pages/{page}'
 */
    const updateForm = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\PageController::update
 * @see app/Http/Controllers/Admin/PageController.php:60
 * @route '/admin/pages/{page}'
 */
        updateForm.put = (args: { page: number | { id: number } } | [page: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
/**
* @see \App\Http\Controllers\Admin\PageController::updateSection
 * @see app/Http/Controllers/Admin/PageController.php:77
 * @route '/admin/sections/{section}'
 */
export const updateSection = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSection.url(args, options),
    method: 'put',
})

updateSection.definition = {
    methods: ["put"],
    url: '/admin/sections/{section}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\PageController::updateSection
 * @see app/Http/Controllers/Admin/PageController.php:77
 * @route '/admin/sections/{section}'
 */
updateSection.url = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { section: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { section: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    section: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        section: typeof args.section === 'object'
                ? args.section.id
                : args.section,
                }

    return updateSection.definition.url
            .replace('{section}', parsedArgs.section.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PageController::updateSection
 * @see app/Http/Controllers/Admin/PageController.php:77
 * @route '/admin/sections/{section}'
 */
updateSection.put = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSection.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\PageController::updateSection
 * @see app/Http/Controllers/Admin/PageController.php:77
 * @route '/admin/sections/{section}'
 */
    const updateSectionForm = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: updateSection.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\PageController::updateSection
 * @see app/Http/Controllers/Admin/PageController.php:77
 * @route '/admin/sections/{section}'
 */
        updateSectionForm.put = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: updateSection.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    updateSection.form = updateSectionForm
/**
* @see \App\Http\Controllers\Admin\PageController::storeSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:194
 * @route '/admin/sections/{section}/items'
 */
export const storeSectionItem = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: storeSectionItem.url(args, options),
    method: 'post',
})

storeSectionItem.definition = {
    methods: ["post"],
    url: '/admin/sections/{section}/items',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\PageController::storeSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:194
 * @route '/admin/sections/{section}/items'
 */
storeSectionItem.url = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { section: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { section: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    section: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        section: typeof args.section === 'object'
                ? args.section.id
                : args.section,
                }

    return storeSectionItem.definition.url
            .replace('{section}', parsedArgs.section.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PageController::storeSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:194
 * @route '/admin/sections/{section}/items'
 */
storeSectionItem.post = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: storeSectionItem.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\PageController::storeSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:194
 * @route '/admin/sections/{section}/items'
 */
    const storeSectionItemForm = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: storeSectionItem.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\PageController::storeSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:194
 * @route '/admin/sections/{section}/items'
 */
        storeSectionItemForm.post = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: storeSectionItem.url(args, options),
            method: 'post',
        })
    
    storeSectionItem.form = storeSectionItemForm
/**
* @see \App\Http\Controllers\Admin\PageController::updateSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:255
 * @route '/admin/section-items/{item}'
 */
export const updateSectionItem = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSectionItem.url(args, options),
    method: 'put',
})

updateSectionItem.definition = {
    methods: ["put"],
    url: '/admin/section-items/{item}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\PageController::updateSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:255
 * @route '/admin/section-items/{item}'
 */
updateSectionItem.url = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { item: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { item: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    item: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        item: typeof args.item === 'object'
                ? args.item.id
                : args.item,
                }

    return updateSectionItem.definition.url
            .replace('{item}', parsedArgs.item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PageController::updateSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:255
 * @route '/admin/section-items/{item}'
 */
updateSectionItem.put = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSectionItem.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\PageController::updateSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:255
 * @route '/admin/section-items/{item}'
 */
    const updateSectionItemForm = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: updateSectionItem.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\PageController::updateSectionItem
 * @see app/Http/Controllers/Admin/PageController.php:255
 * @route '/admin/section-items/{item}'
 */
        updateSectionItemForm.put = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: updateSectionItem.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    updateSectionItem.form = updateSectionItemForm
/**
* @see \App\Http\Controllers\Admin\PageController::destroySectionItem
 * @see app/Http/Controllers/Admin/PageController.php:329
 * @route '/admin/section-items/{item}'
 */
export const destroySectionItem = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroySectionItem.url(args, options),
    method: 'delete',
})

destroySectionItem.definition = {
    methods: ["delete"],
    url: '/admin/section-items/{item}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\PageController::destroySectionItem
 * @see app/Http/Controllers/Admin/PageController.php:329
 * @route '/admin/section-items/{item}'
 */
destroySectionItem.url = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { item: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { item: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    item: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        item: typeof args.item === 'object'
                ? args.item.id
                : args.item,
                }

    return destroySectionItem.definition.url
            .replace('{item}', parsedArgs.item.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PageController::destroySectionItem
 * @see app/Http/Controllers/Admin/PageController.php:329
 * @route '/admin/section-items/{item}'
 */
destroySectionItem.delete = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroySectionItem.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\PageController::destroySectionItem
 * @see app/Http/Controllers/Admin/PageController.php:329
 * @route '/admin/section-items/{item}'
 */
    const destroySectionItemForm = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroySectionItem.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\PageController::destroySectionItem
 * @see app/Http/Controllers/Admin/PageController.php:329
 * @route '/admin/section-items/{item}'
 */
        destroySectionItemForm.delete = (args: { item: number | { id: number } } | [item: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroySectionItem.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroySectionItem.form = destroySectionItemForm
const PageController = { index, edit, update, updateSection, storeSectionItem, updateSectionItem, destroySectionItem }

export default PageController