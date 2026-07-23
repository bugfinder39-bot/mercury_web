import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\CertificationController::toggleStatus
 * @see app/Http/Controllers/Admin/CertificationController.php:230
 * @route '/admin/certifications/{certification}/toggle-status'
 */
export const toggleStatus = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

toggleStatus.definition = {
    methods: ["patch"],
    url: '/admin/certifications/{certification}/toggle-status',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::toggleStatus
 * @see app/Http/Controllers/Admin/CertificationController.php:230
 * @route '/admin/certifications/{certification}/toggle-status'
 */
toggleStatus.url = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { certification: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { certification: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    certification: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        certification: typeof args.certification === 'object'
                ? args.certification.id
                : args.certification,
                }

    return toggleStatus.definition.url
            .replace('{certification}', parsedArgs.certification.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::toggleStatus
 * @see app/Http/Controllers/Admin/CertificationController.php:230
 * @route '/admin/certifications/{certification}/toggle-status'
 */
toggleStatus.patch = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::toggleStatus
 * @see app/Http/Controllers/Admin/CertificationController.php:230
 * @route '/admin/certifications/{certification}/toggle-status'
 */
    const toggleStatusForm = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: toggleStatus.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PATCH',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::toggleStatus
 * @see app/Http/Controllers/Admin/CertificationController.php:230
 * @route '/admin/certifications/{certification}/toggle-status'
 */
        toggleStatusForm.patch = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: toggleStatus.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    toggleStatus.form = toggleStatusForm
/**
* @see \App\Http\Controllers\Admin\CertificationController::reorder
 * @see app/Http/Controllers/Admin/CertificationController.php:242
 * @route '/admin/certifications/reorder'
 */
export const reorder = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reorder.url(options),
    method: 'post',
})

reorder.definition = {
    methods: ["post"],
    url: '/admin/certifications/reorder',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::reorder
 * @see app/Http/Controllers/Admin/CertificationController.php:242
 * @route '/admin/certifications/reorder'
 */
reorder.url = (options?: RouteQueryOptions) => {
    return reorder.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::reorder
 * @see app/Http/Controllers/Admin/CertificationController.php:242
 * @route '/admin/certifications/reorder'
 */
reorder.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reorder.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::reorder
 * @see app/Http/Controllers/Admin/CertificationController.php:242
 * @route '/admin/certifications/reorder'
 */
    const reorderForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: reorder.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::reorder
 * @see app/Http/Controllers/Admin/CertificationController.php:242
 * @route '/admin/certifications/reorder'
 */
        reorderForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: reorder.url(options),
            method: 'post',
        })
    
    reorder.form = reorderForm
/**
* @see \App\Http\Controllers\Admin\CertificationController::duplicate
 * @see app/Http/Controllers/Admin/CertificationController.php:260
 * @route '/admin/certifications/{certification}/duplicate'
 */
export const duplicate = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: duplicate.url(args, options),
    method: 'post',
})

duplicate.definition = {
    methods: ["post"],
    url: '/admin/certifications/{certification}/duplicate',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::duplicate
 * @see app/Http/Controllers/Admin/CertificationController.php:260
 * @route '/admin/certifications/{certification}/duplicate'
 */
duplicate.url = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { certification: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { certification: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    certification: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        certification: typeof args.certification === 'object'
                ? args.certification.id
                : args.certification,
                }

    return duplicate.definition.url
            .replace('{certification}', parsedArgs.certification.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::duplicate
 * @see app/Http/Controllers/Admin/CertificationController.php:260
 * @route '/admin/certifications/{certification}/duplicate'
 */
duplicate.post = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: duplicate.url(args, options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::duplicate
 * @see app/Http/Controllers/Admin/CertificationController.php:260
 * @route '/admin/certifications/{certification}/duplicate'
 */
    const duplicateForm = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: duplicate.url(args, options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::duplicate
 * @see app/Http/Controllers/Admin/CertificationController.php:260
 * @route '/admin/certifications/{certification}/duplicate'
 */
        duplicateForm.post = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: duplicate.url(args, options),
            method: 'post',
        })
    
    duplicate.form = duplicateForm
/**
* @see \App\Http\Controllers\Admin\CertificationController::updateSectionSettings
 * @see app/Http/Controllers/Admin/CertificationController.php:273
 * @route '/admin/certifications/section-settings'
 */
export const updateSectionSettings = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSectionSettings.url(options),
    method: 'put',
})

updateSectionSettings.definition = {
    methods: ["put"],
    url: '/admin/certifications/section-settings',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::updateSectionSettings
 * @see app/Http/Controllers/Admin/CertificationController.php:273
 * @route '/admin/certifications/section-settings'
 */
updateSectionSettings.url = (options?: RouteQueryOptions) => {
    return updateSectionSettings.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::updateSectionSettings
 * @see app/Http/Controllers/Admin/CertificationController.php:273
 * @route '/admin/certifications/section-settings'
 */
updateSectionSettings.put = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSectionSettings.url(options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::updateSectionSettings
 * @see app/Http/Controllers/Admin/CertificationController.php:273
 * @route '/admin/certifications/section-settings'
 */
    const updateSectionSettingsForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: updateSectionSettings.url({
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::updateSectionSettings
 * @see app/Http/Controllers/Admin/CertificationController.php:273
 * @route '/admin/certifications/section-settings'
 */
        updateSectionSettingsForm.put = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: updateSectionSettings.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    updateSectionSettings.form = updateSectionSettingsForm
/**
* @see \App\Http\Controllers\Admin\CertificationController::index
 * @see app/Http/Controllers/Admin/CertificationController.php:31
 * @route '/admin/certifications'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/certifications',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::index
 * @see app/Http/Controllers/Admin/CertificationController.php:31
 * @route '/admin/certifications'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::index
 * @see app/Http/Controllers/Admin/CertificationController.php:31
 * @route '/admin/certifications'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\CertificationController::index
 * @see app/Http/Controllers/Admin/CertificationController.php:31
 * @route '/admin/certifications'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::index
 * @see app/Http/Controllers/Admin/CertificationController.php:31
 * @route '/admin/certifications'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::index
 * @see app/Http/Controllers/Admin/CertificationController.php:31
 * @route '/admin/certifications'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\CertificationController::index
 * @see app/Http/Controllers/Admin/CertificationController.php:31
 * @route '/admin/certifications'
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
* @see \App\Http\Controllers\Admin\CertificationController::create
 * @see app/Http/Controllers/Admin/CertificationController.php:76
 * @route '/admin/certifications/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/certifications/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::create
 * @see app/Http/Controllers/Admin/CertificationController.php:76
 * @route '/admin/certifications/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::create
 * @see app/Http/Controllers/Admin/CertificationController.php:76
 * @route '/admin/certifications/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\CertificationController::create
 * @see app/Http/Controllers/Admin/CertificationController.php:76
 * @route '/admin/certifications/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::create
 * @see app/Http/Controllers/Admin/CertificationController.php:76
 * @route '/admin/certifications/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::create
 * @see app/Http/Controllers/Admin/CertificationController.php:76
 * @route '/admin/certifications/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\CertificationController::create
 * @see app/Http/Controllers/Admin/CertificationController.php:76
 * @route '/admin/certifications/create'
 */
        createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    create.form = createForm
/**
* @see \App\Http\Controllers\Admin\CertificationController::store
 * @see app/Http/Controllers/Admin/CertificationController.php:87
 * @route '/admin/certifications'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/certifications',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::store
 * @see app/Http/Controllers/Admin/CertificationController.php:87
 * @route '/admin/certifications'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::store
 * @see app/Http/Controllers/Admin/CertificationController.php:87
 * @route '/admin/certifications'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::store
 * @see app/Http/Controllers/Admin/CertificationController.php:87
 * @route '/admin/certifications'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::store
 * @see app/Http/Controllers/Admin/CertificationController.php:87
 * @route '/admin/certifications'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\CertificationController::show
 * @see app/Http/Controllers/Admin/CertificationController.php:0
 * @route '/admin/certifications/{certification}'
 */
export const show = (args: { certification: string | number } | [certification: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/certifications/{certification}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::show
 * @see app/Http/Controllers/Admin/CertificationController.php:0
 * @route '/admin/certifications/{certification}'
 */
show.url = (args: { certification: string | number } | [certification: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { certification: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    certification: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        certification: args.certification,
                }

    return show.definition.url
            .replace('{certification}', parsedArgs.certification.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::show
 * @see app/Http/Controllers/Admin/CertificationController.php:0
 * @route '/admin/certifications/{certification}'
 */
show.get = (args: { certification: string | number } | [certification: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\CertificationController::show
 * @see app/Http/Controllers/Admin/CertificationController.php:0
 * @route '/admin/certifications/{certification}'
 */
show.head = (args: { certification: string | number } | [certification: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::show
 * @see app/Http/Controllers/Admin/CertificationController.php:0
 * @route '/admin/certifications/{certification}'
 */
    const showForm = (args: { certification: string | number } | [certification: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::show
 * @see app/Http/Controllers/Admin/CertificationController.php:0
 * @route '/admin/certifications/{certification}'
 */
        showForm.get = (args: { certification: string | number } | [certification: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\CertificationController::show
 * @see app/Http/Controllers/Admin/CertificationController.php:0
 * @route '/admin/certifications/{certification}'
 */
        showForm.head = (args: { certification: string | number } | [certification: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
/**
* @see \App\Http\Controllers\Admin\CertificationController::edit
 * @see app/Http/Controllers/Admin/CertificationController.php:134
 * @route '/admin/certifications/{certification}/edit'
 */
export const edit = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/certifications/{certification}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::edit
 * @see app/Http/Controllers/Admin/CertificationController.php:134
 * @route '/admin/certifications/{certification}/edit'
 */
edit.url = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { certification: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { certification: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    certification: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        certification: typeof args.certification === 'object'
                ? args.certification.id
                : args.certification,
                }

    return edit.definition.url
            .replace('{certification}', parsedArgs.certification.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::edit
 * @see app/Http/Controllers/Admin/CertificationController.php:134
 * @route '/admin/certifications/{certification}/edit'
 */
edit.get = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\CertificationController::edit
 * @see app/Http/Controllers/Admin/CertificationController.php:134
 * @route '/admin/certifications/{certification}/edit'
 */
edit.head = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::edit
 * @see app/Http/Controllers/Admin/CertificationController.php:134
 * @route '/admin/certifications/{certification}/edit'
 */
    const editForm = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::edit
 * @see app/Http/Controllers/Admin/CertificationController.php:134
 * @route '/admin/certifications/{certification}/edit'
 */
        editForm.get = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\CertificationController::edit
 * @see app/Http/Controllers/Admin/CertificationController.php:134
 * @route '/admin/certifications/{certification}/edit'
 */
        editForm.head = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\CertificationController::update
 * @see app/Http/Controllers/Admin/CertificationController.php:145
 * @route '/admin/certifications/{certification}'
 */
export const update = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/certifications/{certification}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::update
 * @see app/Http/Controllers/Admin/CertificationController.php:145
 * @route '/admin/certifications/{certification}'
 */
update.url = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { certification: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { certification: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    certification: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        certification: typeof args.certification === 'object'
                ? args.certification.id
                : args.certification,
                }

    return update.definition.url
            .replace('{certification}', parsedArgs.certification.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::update
 * @see app/Http/Controllers/Admin/CertificationController.php:145
 * @route '/admin/certifications/{certification}'
 */
update.put = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\Admin\CertificationController::update
 * @see app/Http/Controllers/Admin/CertificationController.php:145
 * @route '/admin/certifications/{certification}'
 */
update.patch = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::update
 * @see app/Http/Controllers/Admin/CertificationController.php:145
 * @route '/admin/certifications/{certification}'
 */
    const updateForm = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::update
 * @see app/Http/Controllers/Admin/CertificationController.php:145
 * @route '/admin/certifications/{certification}'
 */
        updateForm.put = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \App\Http\Controllers\Admin\CertificationController::update
 * @see app/Http/Controllers/Admin/CertificationController.php:145
 * @route '/admin/certifications/{certification}'
 */
        updateForm.patch = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
/**
* @see \App\Http\Controllers\Admin\CertificationController::destroy
 * @see app/Http/Controllers/Admin/CertificationController.php:214
 * @route '/admin/certifications/{certification}'
 */
export const destroy = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/certifications/{certification}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\CertificationController::destroy
 * @see app/Http/Controllers/Admin/CertificationController.php:214
 * @route '/admin/certifications/{certification}'
 */
destroy.url = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { certification: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { certification: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    certification: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        certification: typeof args.certification === 'object'
                ? args.certification.id
                : args.certification,
                }

    return destroy.definition.url
            .replace('{certification}', parsedArgs.certification.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\CertificationController::destroy
 * @see app/Http/Controllers/Admin/CertificationController.php:214
 * @route '/admin/certifications/{certification}'
 */
destroy.delete = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\CertificationController::destroy
 * @see app/Http/Controllers/Admin/CertificationController.php:214
 * @route '/admin/certifications/{certification}'
 */
    const destroyForm = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\CertificationController::destroy
 * @see app/Http/Controllers/Admin/CertificationController.php:214
 * @route '/admin/certifications/{certification}'
 */
        destroyForm.delete = (args: { certification: number | { id: number } } | [certification: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const CertificationController = { toggleStatus, reorder, duplicate, updateSectionSettings, index, create, store, show, edit, update, destroy }

export default CertificationController