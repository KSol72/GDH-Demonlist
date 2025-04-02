for arg in "$@"
do
  case $arg in
    --message=*)
      MESSAGE="${arg#*=}"
      shift
      ;;
    *)
      echo "Unknown option: $arg"
      ;;
  esac
done

git add .
git commit -m "$MESSAGE"
git push