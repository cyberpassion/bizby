import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter } from '@/components/ui/card';

interface FormWrapperProps {
    onSubmit: (data: any) => void;
    handleSubmit: any;
    loading?: boolean;
    children: React.ReactNode;
}

export function FormWrapper({
    onSubmit,
    handleSubmit,
    loading = false,
    children,
}: FormWrapperProps) {
    return (
        <Card className="w-full border-0 bg-transparent p-4 shadow-none">
            <form onSubmit={handleSubmit(onSubmit)}>
                <CardContent className="grid grid-cols-12 gap-4">
                    {children}
                </CardContent>

                <CardFooter className="flex justify-start pt-4">
                    <Button type="submit" disabled={loading}>
                        {loading ? 'Saving...' : 'Save'}
                    </Button>
                </CardFooter>
            </form>
        </Card>
    );
}
