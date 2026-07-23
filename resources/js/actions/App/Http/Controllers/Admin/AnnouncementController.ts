import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::toggleStatus
 * @see app/Http/Controllers/Admin/AnnouncementController.php:205
 * @route '/admin/announcements/{announcement}/toggle-status'
 */
export const toggleStatus = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

toggleStatus.definition = {
    methods: ["patch"],
    url: '/admin/announcements/{announcement}/toggle-status',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::toggleStatus
 * @see app/Http/Controllers/Admin/AnnouncementController.php:205
 * @route '/admin/announcements/{announcement}/toggle-status'
 */
toggleStatus.url = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { announcement: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { announcement: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    announcement: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        announcement: typeof args.announcement === 'object'
                ? args.announcement.id
                : args.announcement,
                }

    return toggleStatus.definition.url
            .replace('{announcement}', parsedArgs.announcement.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::toggleStatus
 * @see app/Http/Controllers/Admin/AnnouncementController.php:205
 * @route '/admin/announcements/{announcement}/toggle-status'
 */
toggleStatus.patch = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::toggleStatus
 * @see app/Http/Controllers/Admin/AnnouncementController.php:205
 * @route '/admin/announcements/{announcement}/toggle-status'
 */
    const toggleStatusForm = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: toggleStatus.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PATCH',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::toggleStatus
 * @see app/Http/Controllers/Admin/AnnouncementController.php:205
 * @route '/admin/announcements/{announcement}/toggle-status'
 */
        toggleStatusForm.patch = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\AnnouncementController::togglePin
 * @see app/Http/Controllers/Admin/AnnouncementController.php:219
 * @route '/admin/announcements/{announcement}/toggle-pin'
 */
export const togglePin = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: togglePin.url(args, options),
    method: 'patch',
})

togglePin.definition = {
    methods: ["patch"],
    url: '/admin/announcements/{announcement}/toggle-pin',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::togglePin
 * @see app/Http/Controllers/Admin/AnnouncementController.php:219
 * @route '/admin/announcements/{announcement}/toggle-pin'
 */
togglePin.url = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { announcement: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { announcement: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    announcement: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        announcement: typeof args.announcement === 'object'
                ? args.announcement.id
                : args.announcement,
                }

    return togglePin.definition.url
            .replace('{announcement}', parsedArgs.announcement.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::togglePin
 * @see app/Http/Controllers/Admin/AnnouncementController.php:219
 * @route '/admin/announcements/{announcement}/toggle-pin'
 */
togglePin.patch = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: togglePin.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::togglePin
 * @see app/Http/Controllers/Admin/AnnouncementController.php:219
 * @route '/admin/announcements/{announcement}/toggle-pin'
 */
    const togglePinForm = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: togglePin.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PATCH',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::togglePin
 * @see app/Http/Controllers/Admin/AnnouncementController.php:219
 * @route '/admin/announcements/{announcement}/toggle-pin'
 */
        togglePinForm.patch = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: togglePin.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    togglePin.form = togglePinForm
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::reorder
 * @see app/Http/Controllers/Admin/AnnouncementController.php:233
 * @route '/admin/announcements/reorder'
 */
export const reorder = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reorder.url(options),
    method: 'post',
})

reorder.definition = {
    methods: ["post"],
    url: '/admin/announcements/reorder',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::reorder
 * @see app/Http/Controllers/Admin/AnnouncementController.php:233
 * @route '/admin/announcements/reorder'
 */
reorder.url = (options?: RouteQueryOptions) => {
    return reorder.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::reorder
 * @see app/Http/Controllers/Admin/AnnouncementController.php:233
 * @route '/admin/announcements/reorder'
 */
reorder.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reorder.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::reorder
 * @see app/Http/Controllers/Admin/AnnouncementController.php:233
 * @route '/admin/announcements/reorder'
 */
    const reorderForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: reorder.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::reorder
 * @see app/Http/Controllers/Admin/AnnouncementController.php:233
 * @route '/admin/announcements/reorder'
 */
        reorderForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: reorder.url(options),
            method: 'post',
        })
    
    reorder.form = reorderForm
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::updateSettings
 * @see app/Http/Controllers/Admin/AnnouncementController.php:253
 * @route '/admin/announcements/settings'
 */
export const updateSettings = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSettings.url(options),
    method: 'put',
})

updateSettings.definition = {
    methods: ["put"],
    url: '/admin/announcements/settings',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::updateSettings
 * @see app/Http/Controllers/Admin/AnnouncementController.php:253
 * @route '/admin/announcements/settings'
 */
updateSettings.url = (options?: RouteQueryOptions) => {
    return updateSettings.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::updateSettings
 * @see app/Http/Controllers/Admin/AnnouncementController.php:253
 * @route '/admin/announcements/settings'
 */
updateSettings.put = (options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: updateSettings.url(options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::updateSettings
 * @see app/Http/Controllers/Admin/AnnouncementController.php:253
 * @route '/admin/announcements/settings'
 */
    const updateSettingsForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: updateSettings.url({
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::updateSettings
 * @see app/Http/Controllers/Admin/AnnouncementController.php:253
 * @route '/admin/announcements/settings'
 */
        updateSettingsForm.put = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: updateSettings.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    updateSettings.form = updateSettingsForm
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::index
 * @see app/Http/Controllers/Admin/AnnouncementController.php:43
 * @route '/admin/announcements'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/announcements',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::index
 * @see app/Http/Controllers/Admin/AnnouncementController.php:43
 * @route '/admin/announcements'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::index
 * @see app/Http/Controllers/Admin/AnnouncementController.php:43
 * @route '/admin/announcements'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::index
 * @see app/Http/Controllers/Admin/AnnouncementController.php:43
 * @route '/admin/announcements'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::index
 * @see app/Http/Controllers/Admin/AnnouncementController.php:43
 * @route '/admin/announcements'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::index
 * @see app/Http/Controllers/Admin/AnnouncementController.php:43
 * @route '/admin/announcements'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::index
 * @see app/Http/Controllers/Admin/AnnouncementController.php:43
 * @route '/admin/announcements'
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
* @see \App\Http\Controllers\Admin\AnnouncementController::create
 * @see app/Http/Controllers/Admin/AnnouncementController.php:100
 * @route '/admin/announcements/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/announcements/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::create
 * @see app/Http/Controllers/Admin/AnnouncementController.php:100
 * @route '/admin/announcements/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::create
 * @see app/Http/Controllers/Admin/AnnouncementController.php:100
 * @route '/admin/announcements/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::create
 * @see app/Http/Controllers/Admin/AnnouncementController.php:100
 * @route '/admin/announcements/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::create
 * @see app/Http/Controllers/Admin/AnnouncementController.php:100
 * @route '/admin/announcements/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::create
 * @see app/Http/Controllers/Admin/AnnouncementController.php:100
 * @route '/admin/announcements/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::create
 * @see app/Http/Controllers/Admin/AnnouncementController.php:100
 * @route '/admin/announcements/create'
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
* @see \App\Http\Controllers\Admin\AnnouncementController::store
 * @see app/Http/Controllers/Admin/AnnouncementController.php:113
 * @route '/admin/announcements'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/announcements',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::store
 * @see app/Http/Controllers/Admin/AnnouncementController.php:113
 * @route '/admin/announcements'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::store
 * @see app/Http/Controllers/Admin/AnnouncementController.php:113
 * @route '/admin/announcements'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::store
 * @see app/Http/Controllers/Admin/AnnouncementController.php:113
 * @route '/admin/announcements'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::store
 * @see app/Http/Controllers/Admin/AnnouncementController.php:113
 * @route '/admin/announcements'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::show
 * @see app/Http/Controllers/Admin/AnnouncementController.php:0
 * @route '/admin/announcements/{announcement}'
 */
export const show = (args: { announcement: string | number } | [announcement: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/announcements/{announcement}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::show
 * @see app/Http/Controllers/Admin/AnnouncementController.php:0
 * @route '/admin/announcements/{announcement}'
 */
show.url = (args: { announcement: string | number } | [announcement: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { announcement: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    announcement: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        announcement: args.announcement,
                }

    return show.definition.url
            .replace('{announcement}', parsedArgs.announcement.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::show
 * @see app/Http/Controllers/Admin/AnnouncementController.php:0
 * @route '/admin/announcements/{announcement}'
 */
show.get = (args: { announcement: string | number } | [announcement: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::show
 * @see app/Http/Controllers/Admin/AnnouncementController.php:0
 * @route '/admin/announcements/{announcement}'
 */
show.head = (args: { announcement: string | number } | [announcement: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::show
 * @see app/Http/Controllers/Admin/AnnouncementController.php:0
 * @route '/admin/announcements/{announcement}'
 */
    const showForm = (args: { announcement: string | number } | [announcement: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::show
 * @see app/Http/Controllers/Admin/AnnouncementController.php:0
 * @route '/admin/announcements/{announcement}'
 */
        showForm.get = (args: { announcement: string | number } | [announcement: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::show
 * @see app/Http/Controllers/Admin/AnnouncementController.php:0
 * @route '/admin/announcements/{announcement}'
 */
        showForm.head = (args: { announcement: string | number } | [announcement: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\AnnouncementController::edit
 * @see app/Http/Controllers/Admin/AnnouncementController.php:147
 * @route '/admin/announcements/{announcement}/edit'
 */
export const edit = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/announcements/{announcement}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::edit
 * @see app/Http/Controllers/Admin/AnnouncementController.php:147
 * @route '/admin/announcements/{announcement}/edit'
 */
edit.url = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { announcement: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { announcement: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    announcement: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        announcement: typeof args.announcement === 'object'
                ? args.announcement.id
                : args.announcement,
                }

    return edit.definition.url
            .replace('{announcement}', parsedArgs.announcement.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::edit
 * @see app/Http/Controllers/Admin/AnnouncementController.php:147
 * @route '/admin/announcements/{announcement}/edit'
 */
edit.get = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::edit
 * @see app/Http/Controllers/Admin/AnnouncementController.php:147
 * @route '/admin/announcements/{announcement}/edit'
 */
edit.head = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::edit
 * @see app/Http/Controllers/Admin/AnnouncementController.php:147
 * @route '/admin/announcements/{announcement}/edit'
 */
    const editForm = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::edit
 * @see app/Http/Controllers/Admin/AnnouncementController.php:147
 * @route '/admin/announcements/{announcement}/edit'
 */
        editForm.get = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::edit
 * @see app/Http/Controllers/Admin/AnnouncementController.php:147
 * @route '/admin/announcements/{announcement}/edit'
 */
        editForm.head = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\AnnouncementController::update
 * @see app/Http/Controllers/Admin/AnnouncementController.php:160
 * @route '/admin/announcements/{announcement}'
 */
export const update = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/announcements/{announcement}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::update
 * @see app/Http/Controllers/Admin/AnnouncementController.php:160
 * @route '/admin/announcements/{announcement}'
 */
update.url = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { announcement: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { announcement: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    announcement: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        announcement: typeof args.announcement === 'object'
                ? args.announcement.id
                : args.announcement,
                }

    return update.definition.url
            .replace('{announcement}', parsedArgs.announcement.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::update
 * @see app/Http/Controllers/Admin/AnnouncementController.php:160
 * @route '/admin/announcements/{announcement}'
 */
update.put = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\Admin\AnnouncementController::update
 * @see app/Http/Controllers/Admin/AnnouncementController.php:160
 * @route '/admin/announcements/{announcement}'
 */
update.patch = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::update
 * @see app/Http/Controllers/Admin/AnnouncementController.php:160
 * @route '/admin/announcements/{announcement}'
 */
    const updateForm = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::update
 * @see app/Http/Controllers/Admin/AnnouncementController.php:160
 * @route '/admin/announcements/{announcement}'
 */
        updateForm.put = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::update
 * @see app/Http/Controllers/Admin/AnnouncementController.php:160
 * @route '/admin/announcements/{announcement}'
 */
        updateForm.patch = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\AnnouncementController::destroy
 * @see app/Http/Controllers/Admin/AnnouncementController.php:194
 * @route '/admin/announcements/{announcement}'
 */
export const destroy = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/announcements/{announcement}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::destroy
 * @see app/Http/Controllers/Admin/AnnouncementController.php:194
 * @route '/admin/announcements/{announcement}'
 */
destroy.url = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { announcement: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { announcement: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    announcement: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        announcement: typeof args.announcement === 'object'
                ? args.announcement.id
                : args.announcement,
                }

    return destroy.definition.url
            .replace('{announcement}', parsedArgs.announcement.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\AnnouncementController::destroy
 * @see app/Http/Controllers/Admin/AnnouncementController.php:194
 * @route '/admin/announcements/{announcement}'
 */
destroy.delete = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\AnnouncementController::destroy
 * @see app/Http/Controllers/Admin/AnnouncementController.php:194
 * @route '/admin/announcements/{announcement}'
 */
    const destroyForm = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\AnnouncementController::destroy
 * @see app/Http/Controllers/Admin/AnnouncementController.php:194
 * @route '/admin/announcements/{announcement}'
 */
        destroyForm.delete = (args: { announcement: number | { id: number } } | [announcement: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const AnnouncementController = { toggleStatus, togglePin, reorder, updateSettings, index, create, store, show, edit, update, destroy }

export default AnnouncementController