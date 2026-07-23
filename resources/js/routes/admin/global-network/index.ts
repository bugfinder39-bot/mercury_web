import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::toggleStatus
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:174
 * @route '/admin/global-network/{global_network}/toggle-status'
 */
export const toggleStatus = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

toggleStatus.definition = {
    methods: ["patch"],
    url: '/admin/global-network/{global_network}/toggle-status',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::toggleStatus
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:174
 * @route '/admin/global-network/{global_network}/toggle-status'
 */
toggleStatus.url = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { global_network: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { global_network: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    global_network: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        global_network: typeof args.global_network === 'object'
                ? args.global_network.id
                : args.global_network,
                }

    return toggleStatus.definition.url
            .replace('{global_network}', parsedArgs.global_network.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::toggleStatus
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:174
 * @route '/admin/global-network/{global_network}/toggle-status'
 */
toggleStatus.patch = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleStatus.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::toggleStatus
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:174
 * @route '/admin/global-network/{global_network}/toggle-status'
 */
    const toggleStatusForm = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: toggleStatus.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PATCH',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::toggleStatus
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:174
 * @route '/admin/global-network/{global_network}/toggle-status'
 */
        toggleStatusForm.patch = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\NetworkLocationController::reorder
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:186
 * @route '/admin/global-network/reorder'
 */
export const reorder = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reorder.url(options),
    method: 'post',
})

reorder.definition = {
    methods: ["post"],
    url: '/admin/global-network/reorder',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::reorder
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:186
 * @route '/admin/global-network/reorder'
 */
reorder.url = (options?: RouteQueryOptions) => {
    return reorder.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::reorder
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:186
 * @route '/admin/global-network/reorder'
 */
reorder.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reorder.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::reorder
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:186
 * @route '/admin/global-network/reorder'
 */
    const reorderForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: reorder.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::reorder
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:186
 * @route '/admin/global-network/reorder'
 */
        reorderForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: reorder.url(options),
            method: 'post',
        })
    
    reorder.form = reorderForm
/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::index
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:17
 * @route '/admin/global-network'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/global-network',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::index
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:17
 * @route '/admin/global-network'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::index
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:17
 * @route '/admin/global-network'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::index
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:17
 * @route '/admin/global-network'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::index
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:17
 * @route '/admin/global-network'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::index
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:17
 * @route '/admin/global-network'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::index
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:17
 * @route '/admin/global-network'
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
* @see \App\Http\Controllers\Admin\NetworkLocationController::create
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:64
 * @route '/admin/global-network/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/global-network/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::create
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:64
 * @route '/admin/global-network/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::create
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:64
 * @route '/admin/global-network/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::create
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:64
 * @route '/admin/global-network/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::create
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:64
 * @route '/admin/global-network/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::create
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:64
 * @route '/admin/global-network/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::create
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:64
 * @route '/admin/global-network/create'
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
* @see \App\Http\Controllers\Admin\NetworkLocationController::store
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:84
 * @route '/admin/global-network'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/admin/global-network',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::store
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:84
 * @route '/admin/global-network'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::store
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:84
 * @route '/admin/global-network'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::store
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:84
 * @route '/admin/global-network'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::store
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:84
 * @route '/admin/global-network'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::show
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:0
 * @route '/admin/global-network/{global_network}'
 */
export const show = (args: { global_network: string | number } | [global_network: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/admin/global-network/{global_network}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::show
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:0
 * @route '/admin/global-network/{global_network}'
 */
show.url = (args: { global_network: string | number } | [global_network: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { global_network: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    global_network: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        global_network: args.global_network,
                }

    return show.definition.url
            .replace('{global_network}', parsedArgs.global_network.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::show
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:0
 * @route '/admin/global-network/{global_network}'
 */
show.get = (args: { global_network: string | number } | [global_network: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::show
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:0
 * @route '/admin/global-network/{global_network}'
 */
show.head = (args: { global_network: string | number } | [global_network: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::show
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:0
 * @route '/admin/global-network/{global_network}'
 */
    const showForm = (args: { global_network: string | number } | [global_network: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::show
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:0
 * @route '/admin/global-network/{global_network}'
 */
        showForm.get = (args: { global_network: string | number } | [global_network: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::show
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:0
 * @route '/admin/global-network/{global_network}'
 */
        showForm.head = (args: { global_network: string | number } | [global_network: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\NetworkLocationController::edit
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:119
 * @route '/admin/global-network/{global_network}/edit'
 */
export const edit = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/admin/global-network/{global_network}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::edit
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:119
 * @route '/admin/global-network/{global_network}/edit'
 */
edit.url = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { global_network: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { global_network: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    global_network: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        global_network: typeof args.global_network === 'object'
                ? args.global_network.id
                : args.global_network,
                }

    return edit.definition.url
            .replace('{global_network}', parsedArgs.global_network.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::edit
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:119
 * @route '/admin/global-network/{global_network}/edit'
 */
edit.get = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::edit
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:119
 * @route '/admin/global-network/{global_network}/edit'
 */
edit.head = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::edit
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:119
 * @route '/admin/global-network/{global_network}/edit'
 */
    const editForm = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::edit
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:119
 * @route '/admin/global-network/{global_network}/edit'
 */
        editForm.get = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::edit
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:119
 * @route '/admin/global-network/{global_network}/edit'
 */
        editForm.head = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \App\Http\Controllers\Admin\NetworkLocationController::update
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:139
 * @route '/admin/global-network/{global_network}'
 */
export const update = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/admin/global-network/{global_network}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::update
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:139
 * @route '/admin/global-network/{global_network}'
 */
update.url = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { global_network: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { global_network: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    global_network: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        global_network: typeof args.global_network === 'object'
                ? args.global_network.id
                : args.global_network,
                }

    return update.definition.url
            .replace('{global_network}', parsedArgs.global_network.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::update
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:139
 * @route '/admin/global-network/{global_network}'
 */
update.put = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::update
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:139
 * @route '/admin/global-network/{global_network}'
 */
update.patch = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::update
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:139
 * @route '/admin/global-network/{global_network}'
 */
    const updateForm = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::update
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:139
 * @route '/admin/global-network/{global_network}'
 */
        updateForm.put = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::update
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:139
 * @route '/admin/global-network/{global_network}'
 */
        updateForm.patch = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \App\Http\Controllers\Admin\NetworkLocationController::destroy
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:204
 * @route '/admin/global-network/{global_network}'
 */
export const destroy = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/global-network/{global_network}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::destroy
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:204
 * @route '/admin/global-network/{global_network}'
 */
destroy.url = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { global_network: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { global_network: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    global_network: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        global_network: typeof args.global_network === 'object'
                ? args.global_network.id
                : args.global_network,
                }

    return destroy.definition.url
            .replace('{global_network}', parsedArgs.global_network.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\NetworkLocationController::destroy
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:204
 * @route '/admin/global-network/{global_network}'
 */
destroy.delete = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::destroy
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:204
 * @route '/admin/global-network/{global_network}'
 */
    const destroyForm = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\NetworkLocationController::destroy
 * @see app/Http/Controllers/Admin/NetworkLocationController.php:204
 * @route '/admin/global-network/{global_network}'
 */
        destroyForm.delete = (args: { global_network: number | { id: number } } | [global_network: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const globalNetwork = {
    toggleStatus: Object.assign(toggleStatus, toggleStatus),
reorder: Object.assign(reorder, reorder),
index: Object.assign(index, index),
create: Object.assign(create, create),
store: Object.assign(store, store),
show: Object.assign(show, show),
edit: Object.assign(edit, edit),
update: Object.assign(update, update),
destroy: Object.assign(destroy, destroy),
}

export default globalNetwork