import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\MessageController::index
 * @see app/Http/Controllers/Admin/MessageController.php:17
 * @route '/admin/messages'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/messages',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\MessageController::index
 * @see app/Http/Controllers/Admin/MessageController.php:17
 * @route '/admin/messages'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\MessageController::index
 * @see app/Http/Controllers/Admin/MessageController.php:17
 * @route '/admin/messages'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\MessageController::index
 * @see app/Http/Controllers/Admin/MessageController.php:17
 * @route '/admin/messages'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Admin\MessageController::toggleRead
 * @see app/Http/Controllers/Admin/MessageController.php:27
 * @route '/admin/messages/{message}/toggle-read'
 */
export const toggleRead = (args: { message: number | { id: number } } | [message: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleRead.url(args, options),
    method: 'patch',
})

toggleRead.definition = {
    methods: ["patch"],
    url: '/admin/messages/{message}/toggle-read',
} satisfies RouteDefinition<["patch"]>

/**
* @see \App\Http\Controllers\Admin\MessageController::toggleRead
 * @see app/Http/Controllers/Admin/MessageController.php:27
 * @route '/admin/messages/{message}/toggle-read'
 */
toggleRead.url = (args: { message: number | { id: number } } | [message: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { message: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { message: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    message: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        message: typeof args.message === 'object'
                ? args.message.id
                : args.message,
                }

    return toggleRead.definition.url
            .replace('{message}', parsedArgs.message.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\MessageController::toggleRead
 * @see app/Http/Controllers/Admin/MessageController.php:27
 * @route '/admin/messages/{message}/toggle-read'
 */
toggleRead.patch = (args: { message: number | { id: number } } | [message: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: toggleRead.url(args, options),
    method: 'patch',
})

/**
* @see \App\Http\Controllers\Admin\MessageController::destroy
 * @see app/Http/Controllers/Admin/MessageController.php:39
 * @route '/admin/messages/{message}'
 */
export const destroy = (args: { message: number | { id: number } } | [message: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/admin/messages/{message}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \App\Http\Controllers\Admin\MessageController::destroy
 * @see app/Http/Controllers/Admin/MessageController.php:39
 * @route '/admin/messages/{message}'
 */
destroy.url = (args: { message: number | { id: number } } | [message: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { message: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { message: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    message: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        message: typeof args.message === 'object'
                ? args.message.id
                : args.message,
                }

    return destroy.definition.url
            .replace('{message}', parsedArgs.message.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\MessageController::destroy
 * @see app/Http/Controllers/Admin/MessageController.php:39
 * @route '/admin/messages/{message}'
 */
destroy.delete = (args: { message: number | { id: number } } | [message: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})
const MessageController = { index, toggleRead, destroy }

export default MessageController